<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\products\barang;
use App\Models\retur\supplier;
use App\Models\riwayat\detail_transaksi;
use App\Models\riwayat\transaksi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pemasukan extends Controller
{
  public function index($date = null)
  {

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

    // data dari retur
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


    $data = array();

    $data_transaksi = $data_pemasukan($date)->toArray();
    $data_retur_supp = $data_pemasukan_from_retur($date)->toArray();
    $data_retur_cs = array(
      // "date" =>null,
      // "total" =>null,
    );

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

    // dd($data);

    // $data = array_merge($data_transaksi, $data_retur_supp);

    // $mergedData = array_reduce($data, function ($result, $item) {
    //   $date = $item['date'];
    //   $total = (int) $item['total'];

    //   if (isset($result[$date])) {
    //     $result[$date]['total'] += $total;
    //   } else {
    //     $result[$date] = [
    //       'date' => $date,
    //       'total' => $total
    //     ];
    //   }

    //   return $result;
    // }, []);

    // $mergedData = array_values($mergedData);

    // dd($mergedData[0]['date']);




    // $dataDetailKategori = transaksi::join('detail_transaksi', 'transaksi.kode_tr', '=', 'detail_transaksi.kode_tr')
    //   ->join('barang', 'detail_transaksi.kode_br', '=', 'barang.kode_br')
    //   ->select('barang.nama_br', 'barang.kategori', 'barang.harga')
    //   ->get();

    // dd($dataDetailKategori);


    $produk_terjual_raw = function ($date) {

      // cek jika ada filter date
      if ($date !== null) {
        $data = json_decode(base64_decode($date));
        // dd($data);

        if ($data->type === 'harian') {
          return detail_transaksi::join('transaksi', 'transaksi.kode_tr', 'detail_transaksi.kode_tr',)
            ->join('barang', 'detail_transaksi.kode_br', '=', 'barang.kode_br')
            ->select('barang.kategori', 'barang.nama_br', 'barang.harga', DB::raw('SUM(detail_transaksi.QTY) as jumlah'))
            ->whereDate('transaksi.tanggal', '=', $data->data)
            ->groupBy('barang.nama_br', 'barang.kategori', 'barang.harga')
            ->get();
        } elseif ($data->type === 'mingguan') {

          // set range date for between sql
          $start_date = Carbon::parse((string)$data->data)->startOfWeek();
          $end_date = Carbon::parse((string)$data->data)->endOfWeek();

          return detail_transaksi::join('transaksi', 'transaksi.kode_tr', 'detail_transaksi.kode_tr',)
            ->join('barang', 'detail_transaksi.kode_br', '=', 'barang.kode_br')
            ->select('barang.kategori', 'barang.nama_br', 'barang.harga', DB::raw('SUM(detail_transaksi.QTY) as jumlah'))
            ->whereBetween('tanggal', [$start_date, $end_date])
            ->groupBy('barang.nama_br', 'barang.kategori', 'barang.harga')
            ->get();
        } elseif ($data->type === 'bulanan') {

          // set tahun & bulan
          $tahun = $data->data->tahun;
          $bulan = $data->data->bulan;

          return detail_transaksi::join('transaksi', 'transaksi.kode_tr', 'detail_transaksi.kode_tr',)
            ->join('barang', 'detail_transaksi.kode_br', '=', 'barang.kode_br')
            ->select('barang.kategori', 'barang.nama_br', 'barang.harga', DB::raw('SUM(detail_transaksi.QTY) as jumlah'))
            ->whereMonth('tanggal', '=', $bulan)
            ->whereYear('tanggal', '=', $tahun)
            ->groupBy('barang.nama_br', 'barang.kategori', 'barang.harga')
            ->get();
        } elseif ($data->type === 'tahunan') {

          // set tahun
          $tahun = $data->data->tahun;

          // return filter date bulanan
          return detail_transaksi::join('transaksi', 'transaksi.kode_tr', 'detail_transaksi.kode_tr',)
            ->join('barang', 'detail_transaksi.kode_br', '=', 'barang.kode_br')
            ->select('barang.kategori', 'barang.nama_br', 'barang.harga', DB::raw('SUM(detail_transaksi.QTY) as jumlah'))
            ->whereYear('tanggal', '=', $tahun)
            ->groupBy('barang.nama_br', 'barang.kategori', 'barang.harga')
            ->get();
        } elseif ($data->type === 'range') {

          $date_awal = $data->data->awal;
          $date_akhir = $data->data->akhir . ' 23:59:00';

          // dd($date_awal . '===' . $date_akhir);
          // return filter date bulanan
          return detail_transaksi::join('transaksi', 'transaksi.kode_tr', 'detail_transaksi.kode_tr',)
            ->join('barang', 'detail_transaksi.kode_br', '=', 'barang.kode_br')
            ->select('barang.kategori', 'barang.nama_br', 'barang.harga', DB::raw('SUM(detail_transaksi.QTY) as jumlah'))
            ->whereBetween('tanggal', [$date_awal, $date_akhir])
            ->groupBy('barang.nama_br', 'barang.kategori', 'barang.harga')
            ->get();
        }
      }

      return detail_transaksi::join('barang', 'detail_transaksi.kode_br', '=', 'barang.kode_br')
        ->select('barang.kategori', 'barang.nama_br', 'barang.harga', DB::raw('SUM(detail_transaksi.QTY) as jumlah'))
        ->groupBy('barang.nama_br', 'barang.kategori', 'barang.harga')
        ->get();
    };

    // dd($produk_terjual($date));


    // dd($produk_terjual);

    $produk_tidak_terjual = barang::leftJoin('detail_transaksi', 'barang.kode_br', '=', 'detail_transaksi.kode_br')
      ->select('barang.kategori', 'barang.nama_br', 'detail_transaksi.kode_tr')
      ->groupBy('barang.kategori', 'barang.nama_br', 'detail_transaksi.kode_tr')
      ->havingRaw('COUNT(detail_transaksi.kode_tr) = 0')
      ->get();

    // total data terjual
    $total = 0;
    foreach ($data_pemasukan($date) as $index) {
      $total += $index->total;
    }

    // total produk terjual
    $totalPria = function ($data) {
      $value = 0;

      foreach ($data as $index) {
        if ($index->kategori === 'pria') {
          $value += $index->harga * $index->jumlah;
        }
      }

      return $value;
    };

    $totalWanita = function ($data) {
      $value = 0;

      foreach ($data as $index) {
        if ($index->kategori === 'wanita') {
          $value += $index->harga * $index->jumlah;
        }
      }

      return $value;
    };

    $totalAnak = function ($data) {
      $value = 0;

      foreach ($data as $index) {
        if ($index->kategori === 'anak') {
          $value += $index->harga * $index->jumlah;
        }
      }

      return $value;
    };

    $produk_terjual = $produk_terjual_raw($date);
    $finalDataDetailKategori = [
      'pria' => $totalPria($produk_terjual),
      'wanita' => $totalWanita($produk_terjual),
      'anak' => $totalAnak($produk_terjual)
    ];
    // dd($produk_tidak_terjual);

    return view('report.pemasukan', compact('data', 'produk_terjual', 'produk_tidak_terjual', 'total', 'finalDataDetailKategori'));
  }
}
