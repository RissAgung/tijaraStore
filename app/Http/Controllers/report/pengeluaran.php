<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\pengeluaran\pengeluaran as ModelPengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class pengeluaran extends Controller
{
  public function index($date = null)
  {

    $dataFilterDate = json_decode(base64_decode($date));

    $dataPengeluaran = function ($data) use (&$titleFilter) {

      // with filter date
      if ($data !== null) {

        // harian 
        if ($data->type === 'harian') {
          $titleFilter = 'Harian';
          return (ModelPengeluaran::whereDate('tanggal', '=', $data->data)
            ->get()
          );
        } elseif ($data->type === 'mingguan') {
          $titleFilter = 'Mingguan';
          // set range date for between sql
          $start_date = Carbon::parse((string)$data->data)->startOfWeek();
          $end_date = Carbon::parse((string)$data->data)->endOfWeek();

          return (ModelPengeluaran::whereBetween('tanggal', [$start_date, $end_date])
            ->get()
          );
        } elseif ($data->type === 'bulanan') {
          $titleFilter = 'Bulanan';
          // set tahun & bulan
          $tahun = $data->data->tahun;
          $bulan = $data->data->bulan;

          return (ModelPengeluaran::whereMonth('tanggal', '=', $bulan)
            ->whereYear('tanggal', '=', $tahun)
            ->get()
          );
        } elseif ($data->type === 'tahunan') {
          $titleFilter = 'Tahunan';
          // set tahun
          $tahun = $data->data->tahun;

          // return filter date bulanan
          return (ModelPengeluaran::whereYear('tanggal', '=', $tahun)
            ->get()
          );
        } elseif ($data->type === 'range') {
          $titleFilter = 'Range';
          $date_awal = $data->data->awal;
          $date_akhir = $data->data->akhir;

          // return filter date range
          return (ModelPengeluaran::whereBetween('tanggal', [$date_awal, $date_akhir])
          );
        }
      }

      $titleFilter = 'Harian';

      // without filter date
      return ModelPengeluaran::get();
    };


    $dataPengeluaranFinal = $dataPengeluaran($dataFilterDate);

    $total_operasional = ModelPengeluaran::getJumlahTotalOperasional($dataFilterDate)[0]->jumlah_total;
    $total_restock = ModelPengeluaran::getJumlahTotalRestock($dataFilterDate)[0]->jumlah_total;

    $total = array(
      'operasional' => $total_operasional,
      'restock' => $total_restock,
      'title' => $titleFilter,
    );

    return view('report.pengeluaran', compact('dataPengeluaranFinal', 'total'));
  }
}
