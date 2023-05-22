<?php

namespace App\Http\Controllers;

use App\Models\model_pegawai;
use App\Models\pengeluaran\pengeluaran;
use App\Models\pengeluaran\pengeluaran_pegawai;
use Illuminate\Console\View\Components\Alert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class pengeluaran_operasioanal extends Controller
{
  public function index(Request $request, $date = null)
  {

    // dd('anu');
    $dataPengeluaran = function ($request, $date) use (&$search, &$ddate) {

      // filter search
      if ($request->has('search')) {

        $search = $request->search;

        return pengeluaran::with('pengeluaran_pegawai.pegawai')
          ->where('kode_pengeluaran', '=', $request->search)
          ->orderBy('tanggal', 'desc')
          ->paginate(10);
      }

      // filter date
      if ($date !== null) {
        $data = json_decode(base64_decode($date));

        $ddate = $date;

        // data for table
        $dateType = function ($data) {
          if ($data->type === 'harian') {
            return (pengeluaran::with('pengeluaran_pegawai.pegawai')
              ->whereDate('tanggal', '=', $data->data)); // return filter date harian
          } elseif ($data->type === 'mingguan') {

            // set range date for between sql
            $start_date = Carbon::parse((string)$data->data)->startOfWeek();
            $end_date = Carbon::parse((string)$data->data)->endOfWeek();

            return (pengeluaran::with('pengeluaran_pegawai.pegawai')
              ->whereBetween('tanggal', [$start_date, $end_date])); // return filter date mingguan

          } elseif ($data->type === 'bulanan') {

            // set tahun & bulan
            $tahun = $data->data->tahun;
            $bulan = $data->data->bulan;

            return (
              // return filter date bulanan
              pengeluaran::with('pengeluaran_pegawai.pegawai')
              ->whereMonth('tanggal', '=', $bulan)
              ->whereYear('tanggal', '=', $tahun)
            );
          } elseif ($data->type === 'tahunan') {

            // set tahun
            $tahun = $data->data->tahun;

            // return filter date bulanan
            return (pengeluaran::with('pengeluaran_pegawai.pegawai')
              ->whereYear('tanggal', '=', $tahun)
            );
          } elseif ($data->type === 'range') {

            $date_awal = $data->data->awal;
            $date_akhir = $data->data->akhir;

            // return filter date range
            return (pengeluaran::with('pengeluaran_pegawai.pegawai')
              ->whereBetween('tanggal', [$date_awal, $date_akhir])
            );
          }
        };

        return $dateType($data)
          ->orderBy('tanggal', 'desc')
          ->paginate(10);
      }

      $search = "";
      $ddate = "";

      return pengeluaran::with('pengeluaran_pegawai.pegawai')
        ->orderBy('tanggal', 'desc')
        ->paginate(10);
    };

    $finalDataPengeluaran = $dataPengeluaran($request, $date);

    // dd($finalDataPengeluaran);

    // apabila terdapat parameter search maka akan tetap pada url
    if ($request->has('search')) {
      $finalDataPengeluaran->appends(array(
        'search' => $request->search
      ));
    }

    $dataUrl = array(
      "search" => $search,
      "date" => $ddate
    );

    // dd($finalDataPengeluaran);


    return view('pengeluaran.operasional', compact('finalDataPengeluaran', 'dataUrl'));
  }

  public function store(Request $request)
  {

    $request->validate([
      'keterangan' => 'required',
      'total' => 'required|max:20',
    ]);

    $id = str_shuffle(date('YmdHis') . 'RTR');
    $kode_pegawai = model_pegawai::select('kode_pegawai')->where('kode_account', '=', Auth::user()->kode_account)->pluck('kode_pegawai')->toArray()[0];
    $total = (int)preg_replace('/\D/', '', $request->total);

    pengeluaran::create([
      'kode_pengeluaran' => $id,
      'tanggal' => Carbon::now(),
      'detail_pengeluaran_pegawai' => 'PEG' . $id,
      'jenis_pengeluaran' => 'operasional',
      'item_operasional' => $request->keterangan,
      'total' => $total
    ]);

    pengeluaran_pegawai::create([
      'pegawai_pengeluaran' => 'PEG' . $id,
      'kode_pegawai' => $kode_pegawai
    ]);

    alert()->success('Berhasil', 'Berhasil Menambahkan Data');
    return redirect()->route('operasional');
  }
}
