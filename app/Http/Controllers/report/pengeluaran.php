<?php

namespace App\Http\Controllers\report;

use App\Exports\ExportLaporanPengeluaran;
use App\Http\Controllers\Controller;
use App\Models\pengeluaran\pengeluaran as ModelPengeluaran;
use App\Models\retur\customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class pengeluaran extends Controller
{
  public function index($date = null)
  {

    $dataFilterDate = json_decode(base64_decode($date));

    // data dari transaksi pengeluaran
    $dataPengeluaran = function ($data) use (&$titleFilter) {

      // with filter date
      if ($data !== null) {

        // dd($data);

        // harian 
        if ($data->type === 'harian') {
          $titleFilter = 'Harian';
          return (ModelPengeluaran::selectRaw('DATE(tanggal) AS tanggal, SUM(total) AS total')
            ->whereDate('tanggal', '=', $data->data)
            ->groupByRaw('DATE(tanggal)')
            ->get()
          );
        } elseif ($data->type === 'mingguan') {
          $titleFilter = 'Mingguan';
          // set range date for between sql
          $start_date = Carbon::parse((string)$data->data)->startOfWeek();
          $end_date = Carbon::parse((string)$data->data)->endOfWeek();

          return (ModelPengeluaran::selectRaw('DATE(tanggal) AS tanggal, SUM(total) AS total')
            ->whereBetween('tanggal', [$start_date, $end_date])
            ->groupByRaw('DATE(tanggal)')
            ->get()
          );
        } elseif ($data->type === 'bulanan') {
          $titleFilter = 'Bulanan';
          // set tahun & bulan
          $tahun = $data->data->tahun;
          $bulan = $data->data->bulan;

          return (ModelPengeluaran::selectRaw('DATE(tanggal) AS tanggal, SUM(total) AS total')
            ->whereMonth('tanggal', '=', $bulan)
            ->whereYear('tanggal', '=', $tahun)
            ->groupByRaw('DATE(tanggal)')
            ->get()
          );
        } elseif ($data->type === 'tahunan') {
          $titleFilter = 'Tahunan';
          // set tahun
          $tahun = $data->data->tahun;

          // return filter date bulanan
          return (ModelPengeluaran::selectRaw('DATE(tanggal) AS tanggal, SUM(total) AS total')
            ->whereYear('tanggal', '=', $tahun)
            ->groupByRaw('DATE(tanggal)')
            ->get()
          );
        } elseif ($data->type === 'range') {
          $titleFilter = 'Range';

          $date_awal = $data->data->awal;
          $date_akhir = $data->data->akhir;

          // return filter date range
          return (ModelPengeluaran::selectRaw('DATE(tanggal) AS tanggal, SUM(total) AS total')
            ->whereBetween('tanggal', [$date_awal, $date_akhir . ' 23:59:00'])
            ->groupByRaw('DATE(tanggal)')
            ->get()
          );
        }
      }

      $titleFilter = '';

      // without filter date
      return ModelPengeluaran::selectRaw('DATE(tanggal) AS tanggal, SUM(total) AS total')
        ->groupByRaw('DATE(tanggal)')
        ->get();
    };

    // data dari retur customer
    $data_pengeluaran_from_retur_cs = function ($data) {

      // cek jika ada filter date
      if ($data !== null) {
        // dd($data);

        if ($data->type === 'harian') {

          return customer::selectRaw('DATE(tanggal) as tanggal, (SUM(IFNULL(bayar_tunai, 0)) + SUM(IFNULL(kembalian_tunai, 0))) AS total')
            ->where('kembalian_tunai', '>', 0)
            ->whereDate('tanggal', '=', $data->data)
            ->orWhere('bayar_tunai', '>', 0)
            ->whereDate('tanggal', '=', $data->data)
            ->groupByRaw('DATE(tanggal)')
            ->get();
        } elseif ($data->type === 'mingguan') {

          // set range date for between sql
          $start_date = Carbon::parse((string)$data->data)->startOfWeek();
          $end_date = Carbon::parse((string)$data->data)->endOfWeek();

          // return filter date mingguan
          return customer::selectRaw('DATE(tanggal) as tanggal, (SUM(IFNULL(bayar_tunai, 0)) + SUM(IFNULL(kembalian_tunai, 0))) AS total')
            ->where('kembalian_tunai', '>', 0)
            ->whereBetween('tanggal', [$start_date, $end_date])
            ->orWhere('bayar_tunai', '>', 0)
            ->whereBetween('tanggal', [$start_date, $end_date])
            ->groupByRaw('DATE(tanggal)')
            ->get();
        } elseif ($data->type === 'bulanan') {

          // set tahun & bulan
          $tahun = $data->data->tahun;
          $bulan = $data->data->bulan;

          // return filter date bulanan
          return customer::selectRaw('DATE(tanggal) as tanggal, (SUM(IFNULL(bayar_tunai, 0)) + SUM(IFNULL(kembalian_tunai, 0))) AS total')
            ->where('kembalian_tunai', '>', 0)
            ->whereMonth('tanggal', '=', $bulan)
            ->whereYear('tanggal', '=', $tahun)
            ->orWhere('bayar_tunai', '>', 0)
            ->whereMonth('tanggal', '=', $bulan)
            ->whereYear('tanggal', '=', $tahun)
            ->groupByRaw('DATE(tanggal)')
            ->get();
        } elseif ($data->type === 'tahunan') {

          // set tahun
          $tahun = $data->data->tahun;

          // return filter date bulanan
          return customer::selectRaw('DATE(tanggal) as tanggal, (SUM(IFNULL(bayar_tunai, 0)) + SUM(IFNULL(kembalian_tunai, 0))) AS total')
            ->where('kembalian_tunai', '>', 0)
            ->whereYear('tanggal', '=', $tahun)
            ->orWhere('bayar_tunai', '>', 0)
            ->whereYear('tanggal', '=', $tahun)
            ->groupByRaw('DATE(tanggal)')
            ->get();
        } elseif ($data->type === 'range') {

          $date_awal = $data->data->awal;
          $date_akhir = $data->data->akhir . ' 23:59:00';

          // return filter date bulanan
          return customer::selectRaw('DATE(tanggal) as tanggal, (SUM(IFNULL(bayar_tunai, 0)) + SUM(IFNULL(kembalian_tunai, 0))) AS total')
            ->where('kembalian_tunai', '>', 0)
            ->whereBetween('tanggal', [$date_awal, $date_akhir])
            ->orWhere('bayar_tunai', '>', 0)
            ->whereBetween('tanggal', [$date_awal, $date_akhir])
            ->groupByRaw('DATE(tanggal)')
            ->get();
        }
      }

      return customer::selectRaw('DATE(tanggal) as tanggal, (SUM(IFNULL(bayar_tunai, 0)) + SUM(IFNULL(kembalian_tunai, 0))) AS total')
        ->where('kembalian_tunai', '>', 0)
        ->orWhere('bayar_tunai', '>', 0)
        ->groupByRaw('DATE(tanggal)')
        ->get();
    };

    $data = array();

    $data_transaksi = $dataPengeluaran($dataFilterDate)->toArray();
    $data_retur_cus = $data_pengeluaran_from_retur_cs($dataFilterDate)->toArray();

    // dd($data_pemasukan_from_retur_cs($dataFilterDate));

    foreach ($data_transaksi as $transaksi) {
      $tanggal = $transaksi["tanggal"];
      $total = $transaksi["total"];

      $data[$tanggal]["tanggal"] = $tanggal;
      $data[$tanggal]["transaksi"] = $total;
    }

    foreach ($data_retur_cus as $transaksi) {
      $tanggal = $transaksi["tanggal"];
      $total = $transaksi["total"];

      $data[$tanggal]["tanggal"] = $tanggal;
      $data[$tanggal]["retur_cs"] = $total;
    }

    foreach ($data as &$transaksi) {
      if (!isset($transaksi["transaksi"])) {
        $transaksi["transaksi"] = "-";
      }
      if (!isset($transaksi["retur_cs"])) {
        $transaksi["retur_cs"] = "-";
      }
    }

    $data = collect($data)->sortByDesc('tanggal');

    $first_date = $data->first() !== null ? $data->first()['tanggal'] : '';
    // dd($data);

    return view('report.pengeluaran', compact('data', 'titleFilter', 'first_date'));
  }

  function getDetail(Request $request)
  {

    ////////////////////////////////// get all data detail //////////////////////////////////
    $operasional = function ($data) {
      return (ModelPengeluaran::with('pengeluaran_pegawai.pegawai')
        ->where('jenis_pengeluaran', 'operasional')
        ->whereDate('tanggal', '=', $data->data_date !== null ? $data->data_date : '')
        ->get()
      );
    };

    $restock = function ($data) {
      return (ModelPengeluaran::with('pengeluaran_pegawai.pegawai', 'pengeluaran_barang.barang')
        ->where('jenis_pengeluaran', 'restock')
        ->whereDate('tanggal', '=', $data->data_date !== null ? $data->data_date : '')
        ->get()
      );
    };

    $retur = function ($data) {
      return customer::with('barangReturCS', 'barangKeluarReturCS')
        ->where(function ($query) use ($data) {
          $query->where('kembalian_tunai', '>', 0)
            ->orWhere('bayar_tunai', '>', 0);
        })
        ->whereDate('tanggal', '=', $data->data_date !== null ? $data->data_date : '')
        ->get();
    };
    ////////////////////////////////// end get all data detail //////////////////////////////////


    return json_encode(
      array(
        'operasional' => $operasional($request),
        'restock' => $restock($request),
        'retur_cs' => $retur($request),
      )
    );
  }

  public function export(Request $request)
  {
    return Excel::download(new ExportLaporanPengeluaran($request), 'laporan_pengeluaran.xlsx');
  }
}
