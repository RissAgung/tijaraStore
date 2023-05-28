<?php

namespace App\Exports;

use App\Models\retur\customer;
use App\Models\retur\supplier;
use App\Models\riwayat\transaksi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportLaporanPemasukan implements FromCollection
{
  /**
   * @return \Illuminate\Support\Collection
   */

  protected $kategori;

  public function __construct(Request $kategori)
  {
    $this->kategori = $kategori->segment(3);
  }

  public function collection()
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

    $data_transaksi = $data_pemasukan($this->kategori)->toArray();
    $data_retur_supp = $data_pemasukan_from_retur($this->kategori)->toArray();
    $data_retur_cs = $data_pemasukan_from_retur_cs($this->kategori)->toArray();

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
        $transaksi["transaksi"] = '0';
      }
      if (!isset($transaksi["retur_supp"])) {
        $transaksi["retur_supp"] = '0';
      }
      if (!isset($transaksi["retur_cs"])) {
        $transaksi["retur_cs"] = '0';
      }
    }


    $data = collect($data)->sortBy('tanggal');
    $data_export = [];
    foreach ($data as $index) {
      $tmp = [$index['tanggal'], $index['transaksi'], $index['retur_cs'], $index['retur_supp'], $index['transaksi'] + $index['retur_cs'] + $index['retur_supp']];
      array_push($data_export, $tmp);
    }

    return new Collection(
      [
        ["Tanggal", "Transaksi Penjualan", "Retur Customer", "Retur Supplier", "Total"],
        $data_export
      ]
    );
  }
}
