<?php

namespace App\Http\Controllers\report;

use App\Exports\ExportLaporanPemasukan;
use App\Http\Controllers\Controller;
use App\Models\products\barang;
use App\Models\retur\customer;
use App\Models\retur\supplier;
use App\Models\riwayat\detail_transaksi;
use App\Models\riwayat\transaksi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class pemasukan extends Controller
{
  public function index($date = null)
  {

    /////////////////////////////////////////////////////// Data Table ///////////////////////////////////////////////////////

    // data dari transaksi
    $data_pemasukan = function ($date) {

      // cek jika ada filter date
      if ($date !== null) {
        $data = json_decode(base64_decode($date));
        // dd($data);

        if ($data->type === 'harian') {
          return transaksi::selectRaw('DATE(tanggal) AS date, SUM(bayar - kembalian) AS total')
            ->whereDate('tanggal', '=', $data->data)
            ->groupByRaw('DATE(tanggal)')
            ->get();
        } elseif ($data->type === 'mingguan') {

          // set range date for between sql
          $start_date = Carbon::parse((string)$data->data)->startOfWeek();
          $end_date = Carbon::parse((string)$data->data)->endOfWeek();

          return transaksi::selectRaw('DATE(tanggal) AS date, SUM(bayar - kembalian) AS total')
            ->whereBetween('tanggal', [$start_date, $end_date])
            ->groupByRaw('DATE(tanggal)')
            ->get();
        } elseif ($data->type === 'bulanan') {

          // set tahun & bulan
          $tahun = $data->data->tahun;
          $bulan = $data->data->bulan;
          // dd($tahun . '===' . $bulan);

          return transaksi::selectRaw('DATE(tanggal) AS date, SUM(bayar - kembalian) AS total')
            ->whereMonth('tanggal', '=', $bulan)
            ->whereYear('tanggal', '=', $tahun)
            ->groupByRaw('DATE(tanggal)')
            ->get();
        } elseif ($data->type === 'tahunan') {

          // set tahun
          $tahun = $data->data->tahun;

          // return filter date bulanan
          return transaksi::selectRaw('DATE(tanggal) AS date, SUM(bayar - kembalian) AS total')
            ->whereYear('tanggal', '=', $tahun)
            ->groupByRaw('DATE(tanggal)')
            ->get();
        } elseif ($data->type === 'range') {

          $date_awal = $data->data->awal;
          $date_akhir = $data->data->akhir . ' 23:59:00';

          // return filter date range
          return transaksi::selectRaw('DATE(tanggal) AS date, SUM(bayar - kembalian) AS total')
            ->whereBetween('tanggal', [$date_awal, $date_akhir])
            ->groupByRaw('DATE(tanggal)')
            ->get();
        }
      }

      return transaksi::selectRaw('DATE(tanggal) AS date, SUM(bayar - kembalian) AS total')
        ->groupByRaw('DATE(tanggal)')
        ->get();
    };

    // data dari retur supplier
    $data_pemasukan_from_retur = function ($date) {

      // cek jika ada filter date
      if ($date !== null) {
        $data = json_decode(base64_decode($date));
        // dd($data);

        if ($data->type === 'harian') {
          return supplier::selectRaw('DATE(tanggal) AS date, SUM(jml_nominal) AS total')
            ->whereDate('tanggal', '=', $data->data)
            ->where('jml_nominal', '>', 0)
            ->groupByRaw('DATE(tanggal)')
            ->get();
        } elseif ($data->type === 'mingguan') {

          // set range date for between sql
          $start_date = Carbon::parse((string)$data->data)->startOfWeek();
          $end_date = Carbon::parse((string)$data->data)->endOfWeek();

          return supplier::selectRaw('DATE(tanggal) AS date, SUM(jml_nominal) AS total')
            ->whereBetween('tanggal', [$start_date, $end_date])
            ->where('jml_nominal', '>', 0)
            ->groupByRaw('DATE(tanggal)')
            ->get();
        } elseif ($data->type === 'bulanan') {

          // set tahun & bulan
          $tahun = $data->data->tahun;
          $bulan = $data->data->bulan;

          return supplier::selectRaw('DATE(tanggal) AS date, SUM(jml_nominal) AS total')
            ->whereMonth('tanggal', '=', $bulan)
            ->whereYear('tanggal', '=', $tahun)
            ->where('jml_nominal', '>', 0)
            ->groupByRaw('DATE(tanggal)')
            ->get();
        } elseif ($data->type === 'tahunan') {

          // set tahun
          $tahun = $data->data->tahun;

          // return filter date bulanan
          return supplier::selectRaw('DATE(tanggal) AS date, SUM(jml_nominal) AS total')
            ->whereYear('tanggal', '=', $tahun)
            ->where('jml_nominal', '>', 0)
            ->groupByRaw('DATE(tanggal)')
            ->get();
        } elseif ($data->type === 'range') {

          $date_awal = $data->data->awal;
          $date_akhir = $data->data->akhir . ' 23:59:00';

          // return filter date bulanan
          return supplier::selectRaw('DATE(tanggal) AS date, SUM(jml_nominal) AS total')
            ->whereBetween('tanggal', [$date_awal, $date_akhir])
            ->where('jml_nominal', '>', 0)
            ->groupByRaw('DATE(tanggal)')
            ->get();
        }
      }

      return supplier::selectRaw('DATE(tanggal) AS date, SUM(jml_nominal) AS total')
        ->where('jml_nominal', '>', 0)
        ->groupByRaw('DATE(tanggal)')
        ->get();
    };

    // data dari retur customer
    $data_pemasukan_from_retur_cs = function ($date) {

      // cek jika ada filter date
      if ($date !== null) {
        $data = json_decode(base64_decode($date));
        // dd($data);

        if ($data->type === 'harian') {

          return customer::selectRaw('DATE(tanggal) AS date, SUM(bayar_kurang) AS total')
            ->whereDate('tanggal', '=', $data->data)
            ->where('bayar_kurang', '>', 0)
            ->groupByRaw('DATE(tanggal)')
            ->get();
        } elseif ($data->type === 'mingguan') {

          // set range date for between sql
          $start_date = Carbon::parse((string)$data->data)->startOfWeek();
          $end_date = Carbon::parse((string)$data->data)->endOfWeek();

          // return filter date mingguan
          return customer::selectRaw('DATE(tanggal) AS date, SUM(bayar_kurang) AS total')
            ->whereBetween('tanggal', [$start_date, $end_date])
            ->where('bayar_kurang', '>', 0)
            ->groupByRaw('DATE(tanggal)')
            ->get();
        } elseif ($data->type === 'bulanan') {

          // set tahun & bulan
          $tahun = $data->data->tahun;
          $bulan = $data->data->bulan;

          // return filter date bulanan
          return customer::selectRaw('DATE(tanggal) AS date, SUM(bayar_kurang) AS total')
            ->whereMonth('tanggal', '=', $bulan)
            ->whereYear('tanggal', '=', $tahun)
            ->where('bayar_kurang', '>', 0)
            ->groupByRaw('DATE(tanggal)')
            ->get();
        } elseif ($data->type === 'tahunan') {

          // set tahun
          $tahun = $data->data->tahun;

          // return filter date bulanan
          return customer::selectRaw('DATE(tanggal) AS date, SUM(bayar_kurang) AS total')
            ->whereYear('tanggal', '=', $tahun)
            ->where('bayar_kurang', '>', 0)
            ->groupByRaw('DATE(tanggal)')
            ->get();
        } elseif ($data->type === 'range') {

          $date_awal = $data->data->awal;
          $date_akhir = $data->data->akhir . ' 23:59:00';

          // return filter date bulanan
          return customer::selectRaw('DATE(tanggal) AS date, SUM(bayar_kurang) AS total')
            ->whereBetween('tanggal', [$date_awal, $date_akhir])
            ->where('bayar_kurang', '>', 0)
            ->groupByRaw('DATE(tanggal)')
            ->get();
        }
      }

      return customer::selectRaw('DATE(tanggal) AS date, SUM(bayar_kurang) AS total')
        ->where('bayar_kurang', '>', 0)
        ->groupByRaw('DATE(tanggal)')
        ->get();
    };

    
    $data = array();
    
    $data_transaksi = $data_pemasukan($date)->toArray();
    $data_retur_supp = $data_pemasukan_from_retur($date)->toArray();
    $data_retur_cs = $data_pemasukan_from_retur_cs($date)->toArray();
    
    // dd($data_transaksi);
    foreach ($data_transaksi as $transaksi) {
      $tanggal = $transaksi["date"];
      $total = $transaksi["total"];

      $data[$tanggal]["tanggal"] = $tanggal;
      $data[$tanggal]["transaksi"] = $total;
    }

    foreach ($data_retur_supp as $transaksi) {
      $tanggal = $transaksi["date"];
      $total = $transaksi["total"];

      $data[$tanggal]["tanggal"] = $tanggal;
      $data[$tanggal]["retur_supp"] = $total;
    }

    foreach ($data_retur_cs as $transaksi) {
      $tanggal = $transaksi["date"];
      $total = $transaksi["total"];

      $data[$tanggal]["tanggal"] = $tanggal;
      $data[$tanggal]["retur_cs"] = $total;
    }

    foreach ($data as &$transaksi) {
      if (!isset($transaksi["transaksi"])) {
        $transaksi["transaksi"] = "-";
      }
      if (!isset($transaksi["retur_supp"])) {
        $transaksi["retur_supp"] = "-";
      }
      if (!isset($transaksi["retur_cs"])) {
        $transaksi["retur_cs"] = "-";
      }
    }


    $data = collect($data)->sortBy('tanggal');
    /////////////////////////////////////////////////////// end Data Table ///////////////////////////////////////////////////////

    $first_date = $data->first() !== null ? $data->first()['tanggal'] : '';

    return view('report.pemasukan', compact('data', 'first_date'));
  }

  function getDetail(Request $request)
  {

    // produk terjual
    $produk_terjual_raw = function ($data) {
      return detail_transaksi::join('transaksi', 'transaksi.kode_tr', 'detail_transaksi.kode_tr',)
        ->join('barang', 'detail_transaksi.kode_br', '=', 'barang.kode_br')
        ->select('barang.kategori', 'barang.nama_br', DB::raw('SUM(detail_transaksi.subtotal) as harga'), DB::raw('SUM(detail_transaksi.QTY) as jumlah'))
        ->whereDate('transaksi.tanggal', '=', $data->data_date !== null ? $data->data_date : '')
        ->groupBy('barang.nama_br', 'barang.kategori')
        ->get();
    };

    // produk tidak terjual
    $barang_terjual = transaksi::join('detail_transaksi', 'transaksi.kode_tr', '=', 'detail_transaksi.kode_tr')
      ->join('barang', 'barang.kode_br', '=', 'detail_transaksi.kode_br')
      ->whereDate('transaksi.tanggal', '=', $request->data_date !== null ? $request->data_date : '')
      ->distinct()
      ->pluck('barang.nama_br');

    $produk_tidak_terjual = Barang::whereNotIn('nama_br', $barang_terjual)
      ->select('kategori', 'nama_br')
      ->get();

    // retur cs & supp
    $detailDataRetur_cs = function ($data) {
      return customer::with('barangReturCS', 'barangKeluarReturCS')
        ->where('bayar_kurang', '>', 0)
        ->whereDate('tanggal', '=', $data->data_date !== null ? $data->data_date : '')
        ->get()
        ->toArray(); //menggunakan array agar dapat mengembalikan data beserta relasinya
    };

    $detailDataRetur_sp = function ($data) {
      return supplier::where('jml_nominal', '>', 0)
        ->whereDate('tanggal', '=', $data->data_date !== null ? $data->data_date : '')
        ->get();
    };

    return json_encode(
      array(
        'produk_terjual' => $produk_terjual_raw($request),
        'produk_tidak_terjual' => $produk_tidak_terjual,
        'retur_cs' => $detailDataRetur_cs($request),
        'retur_sp' => $detailDataRetur_sp($request)
      )
    );
  }

  public function export(Request $request)
  {
    return Excel::download(new ExportLaporanPemasukan($request), 'laporan_pemasukan.xlsx');
  }
}
