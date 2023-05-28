<?php

namespace App\Http\Controllers;

use App\Exports\re_stock;
use App\Exports\re_stock2;
use App\Models\model_pegawai;
use App\Models\pengeluaran\pengeluaran;
use App\Models\pengeluaran\pengeluaran_barang;
use App\Models\pengeluaran\pengeluaran_pegawai;
use App\Models\products\barang;
use App\Models\suplaier\suplaier;
use App\Models\supplier;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Facades\Excel;


class pengeluaran_re_stock extends Controller
{
    public function index(Request $request, $date = null)
    {
        $datafinal = function ($request1, $date) {
            if ($request1->input('search')) {
                return pengeluaran::with('pengeluaran_pegawai.pegawai')
                    ->join('pengeluaran_pegawai', 'pengeluaran.detail_pengeluaran_pegawai', 'pengeluaran_pegawai.pegawai_pengeluaran')
                    ->join('pegawai', 'pengeluaran_pegawai.kode_pegawai', 'pegawai.kode_pegawai')
                    ->where('pegawai.nama', '=', $request1->search)
                    ->orWhere('kode_pengeluaran', '=', $request1->search)
                    ->paginate(5);
            } elseif ($date !== null) {
                $data = json_decode(base64_decode($date));

                if ($data->type === 'harian') {
                    return pengeluaran::with('pengeluaran_pegawai.pegawai')
                        ->join('pengeluaran_pegawai', 'pengeluaran.detail_pengeluaran_pegawai', 'pengeluaran_pegawai.pegawai_pengeluaran')
                        ->join('pegawai', 'pengeluaran_pegawai.kode_pegawai', 'pegawai.kode_pegawai')
                        ->whereDate('tanggal', '=', $data->data)
                        ->paginate(5);
                } elseif ($data->type === 'mingguan') {
                    $start_date = Carbon::parse((string) $data->data)->startOfWeek();
                    $end_date = Carbon::parse((string) $data->data)->endOfWeek();

                    return pengeluaran::with('pengeluaran_pegawai.pegawai')
                        ->join('pengeluaran_pegawai', 'pengeluaran.detail_pengeluaran_pegawai', 'pengeluaran_pegawai.pegawai_pengeluaran')
                        ->join('pegawai', 'pengeluaran_pegawai.kode_pegawai', 'pegawai.kode_pegawai')
                        ->whereBetween('tanggal', [$start_date, $end_date])->paginate(5);
                } elseif ($data->type === 'bulanan') {
                    $tahun = $data->data->tahun;
                    $bulan = $data->data->bulan;
                    return pengeluaran::with('pengeluaran_pegawai.pegawai')
                        ->join('pengeluaran_pegawai', 'pengeluaran.detail_pengeluaran_pegawai', 'pengeluaran_pegawai.pegawai_pengeluaran')
                        ->join('pegawai', 'pengeluaran_pegawai.kode_pegawai', 'pegawai.kode_pegawai')
                        ->whereMonth('tanggal', '=', $bulan)
                        ->whereYear('tanggal', '=', $tahun)->paginate(5);
                } elseif ($data->type === 'tahunan') {
                    $tahun = $data->data->tahun;
                    return pengeluaran::with('pengeluaran_pegawai.pegawai')
                        ->join('pengeluaran_pegawai', 'pengeluaran.detail_pengeluaran_pegawai', 'pengeluaran_pegawai.pegawai_pengeluaran')
                        ->join('pegawai', 'pengeluaran_pegawai.kode_pegawai', 'pegawai.kode_pegawai')
                        ->whereYear('tanggal', '=', $tahun)->paginate(5);
                } elseif ($data->type === 'range') {
                    $date_awal = $data->data->awal;
                    $date_akhir = $data->data->akhir;
                    return pengeluaran::with('pengeluaran_pegawai.pegawai')
                        ->join('pengeluaran_pegawai', 'pengeluaran.detail_pengeluaran_pegawai', 'pengeluaran_pegawai.pegawai_pengeluaran')
                        ->join('pegawai', 'pengeluaran_pegawai.kode_pegawai', 'pegawai.kode_pegawai')
                        ->whereBetween('tanggal', [$date_awal, $date_akhir])->paginate(5);
                }
            } 
                return pengeluaran::with('pengeluaran_barang.barang')->paginate(5);
            
        };
        $barang = barang::all();
        $pegawai = pengeluaran::with('pengeluaran_pegawai.pegawai')->where('pengeluaran_pegawai.kode_pegawai', Auth::user()->kode_pegawai);
        $suplaier = supplier::all();
        $data = $datafinal($request,$date);

    $combinedata = compact('data', 'barang', 'pegawai', 'suplaier');
    return view('pengeluaran.data_pengeluaran_mainR', compact('combinedata'));
  }

  public function store(Request $request)
  {
    // dd($request);
    // $barang = barang::get();
    $request->validate([
      'jumlah' => 'required|max:20|',
      'total' => 'required|max:20',
    ]);

    // dd($request);
    // dd('awjowajojwaojwa');

    $id = str_shuffle(date('YmdHis') . 'RTR');
    $total = (int) preg_replace('/\D/', '', $request->total);
    // $pegawai = modelAuth::user()->kode_pegawai);
    try {
      pengeluaran::create([
        'kode_pengeluaran' => $id,
        'tanggal' => Carbon::now(),
        'detail_pengeluaran_pegawai' => 'PEG' . $id,
        //jenis pengeluaran ini ambil nilai dari tab bar
        'jenis_pengeluaran' => 'restock',
        // 'item_operasional' => $request->barang,
        'detail_pengeluaran_barang' => 'PEB' . $id,
        'jumlah' => $request->jumlah,
        'total' => $total,
      ]);
      pengeluaran_barang::create([
        'detail_pengeluaran_barang' => 'PEB' . $id,
        'kode_br' => $request->barang,
      ]);
      pengeluaran_pegawai::create([
        'pegawai_pengeluaran' => 'PEG' . $id,
        'kode_pegawai' => Auth::user()->kode_pegawai,
      ]);
    } catch (\Throwable $th) {
      dd($th);
    }

        alert()->success('Berhasil', 'Berhasil Menambahkan restock');
        return redirect()->route('halaman_restock');
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        //dd($search);
        $pegawai = pengeluaran::with('pengeluaran_pegawai.pegawai');
        if ($pegawai) {
            $pegawai->where('kode_pengeluaran', 'like', '%' . $search . '%')->orWhere('pegawai.nama', 'like', '%' . $search . '%');
            toast('ini data nya', 'success')
                ->position('top')
                ->autoClose(3000);
            return view('pengeluaran.data_pengeluaran_mainR');
        } else {
            toast('gagal', 'error')
                ->position('top')
                ->autoClose(3000);
        }

        // $pegawai = pengeluaran::where('kode_pengeluaran', 'like', '%' . $search . '%')
        //     ->orWhere('kode_pegawai', 'like', '%' . $search . '%')
        //     ->get();
        // return view('pegawai.data_pegawai', ['pegawai' => $pegawai]);
    }

  public function export()
  {
    return Excel::download(new re_stock(), 're-stock.xlsx');
    // return redirect()->route('halaman_restock');
  }
}
