<?php

namespace App\Exports;

use App\Models\pengeluaran\pengeluaran;
use App\Models\retur\customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportLaporanPengeluaran implements FromCollection
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

    // data dari transaksi pengeluaran
    $dataPengeluaran = function ($date) {

      $data = json_decode(base64_decode($date));
      // with filter date
      if ($data !== null) {

        // dd($data);

        // harian 
        if ($data->type === 'harian') {
          return (pengeluaran::selectRaw('DATE(tanggal) AS tanggal, SUM(total) AS total')
            ->whereDate('tanggal', '=', $data->data)
            ->groupByRaw('DATE(tanggal)')
            ->get()
          );
        } elseif ($data->type === 'mingguan') {
          // set range date for between sql
          $start_date = Carbon::parse((string)$data->data)->startOfWeek();
          $end_date = Carbon::parse((string)$data->data)->endOfWeek();

          return (pengeluaran::selectRaw('DATE(tanggal) AS tanggal, SUM(total) AS total')
            ->whereBetween('tanggal', [$start_date, $end_date])
            ->groupByRaw('DATE(tanggal)')
            ->get()
          );
        } elseif ($data->type === 'bulanan') {
          // set tahun & bulan
          $tahun = $data->data->tahun;
          $bulan = $data->data->bulan;

          return (pengeluaran::selectRaw('DATE(tanggal) AS tanggal, SUM(total) AS total')
            ->whereMonth('tanggal', '=', $bulan)
            ->whereYear('tanggal', '=', $tahun)
            ->groupByRaw('DATE(tanggal)')
            ->get()
          );
        } elseif ($data->type === 'tahunan') {
          // set tahun
          $tahun = $data->data->tahun;

          // return filter date bulanan
          return (pengeluaran::selectRaw('DATE(tanggal) AS tanggal, SUM(total) AS total')
            ->whereYear('tanggal', '=', $tahun)
            ->groupByRaw('DATE(tanggal)')
            ->get()
          );
        } elseif ($data->type === 'range') {

          $date_awal = $data->data->awal;
          $date_akhir = $data->data->akhir;

          // return filter date range
          return (pengeluaran::selectRaw('DATE(tanggal) AS tanggal, SUM(total) AS total')
            ->whereBetween('tanggal', [$date_awal, $date_akhir . ' 23:59:00'])
            ->groupByRaw('DATE(tanggal)')
            ->get()
          );
        }
      }

      // without filter date
      return pengeluaran::selectRaw('DATE(tanggal) AS tanggal, SUM(total) AS total')
        ->groupByRaw('DATE(tanggal)')
        ->get();
    };

    // data dari retur customer
    $data_pengeluaran_from_retur_cs = function ($date) {

      $data = json_decode(base64_decode($date));

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

    $data_transaksi = $dataPengeluaran($this->kategori)->toArray();
    $data_retur_cus = $data_pengeluaran_from_retur_cs($this->kategori)->toArray();

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
        $transaksi["transaksi"] = "0";
      }
      if (!isset($transaksi["retur_cs"])) {
        $transaksi["retur_cs"] = "0";
      }
    }

    $data = collect($data)->sortBy('tanggal');
    $data_export = [];
    foreach ($data as $index) {
      $tmp = [$index['tanggal'], $index['transaksi'], $index['retur_cs'], $index['transaksi'] + $index['retur_cs']];
      array_push($data_export, $tmp);
    }

    return new Collection(
      [
        ["Tanggal", "Transaksi Pengeluaran", "Retur Customer", "Total"],
        $data_export
      ]
    );
  }
}
