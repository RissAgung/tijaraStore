<?php

namespace App\Http\Controllers;

use App\Models\retur\supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RiwayatRetur extends Controller
{
  public function index(Request $request, $date = null)
  {

    // data for table
    $dataReturDB = function ($request, $date) use (&$search, &$ddate) {

      // filter search and date
      if ($request->search !== null && $date !== null) {

        // data from filter date
        $data = json_decode(base64_decode($date));

        // set for return daraUrl
        $ddate = $date;
        $search = $request->search;

        // set model with filter date
        $dateType = function ($data, $search) {
          if ($data->type === 'harian') {

            return (
              // search by kode_retur + filter date harian 
              supplier::where('kode_retur', 'LIKE', '%' . $search . '%')
              ->whereDate('tanggal', '=', $data->data)

              // search by nama_br + filter date harian 
              ->orWhere('nama_br', 'LIKE', '%' . $search . '%')
              ->whereDate('tanggal', '=', $data->data)
            );
          } elseif ($data->type === 'mingguan') {

            // set range date for between sql
            $start_date = Carbon::parse((string)$data->data)->startOfWeek();
            $end_date = Carbon::parse((string)$data->data)->endOfWeek();

            return (
              // search by kode_retur + filter date mingguan 
              supplier::where('kode_retur', 'LIKE', '%' . $search . '%')
              ->whereBetween('tanggal', [$start_date, $end_date])

              // search by nama_br + filter date mingguan 
              ->orWhere('nama_br', 'LIKE', '%' . $search . '%')
              ->whereBetween('tanggal', [$start_date, $end_date])
            );
            // return dd($start_date->toDateString() . " - " . $end_date->toDateString());
          } elseif ($data->type === 'bulanan') {

            // set year and month
            $tahun = $data->data->tahun;
            $bulan = $data->data->bulan;

            return (
              // search by kode_retur + filter date bulanan
              supplier::where('kode_retur', 'LIKE', '%' . $search . '%')
              ->whereMonth('tanggal', '=', $bulan)
              ->whereYear('tanggal', '=', $tahun)

              // search by nama_br + filter date bulanan
              ->orWhere('nama_br', 'LIKE', '%' . $search . '%')
              ->whereMonth('tanggal', '=', $bulan)
              ->whereYear('tanggal', '=', $tahun)
            );
          } elseif ($data->type === 'tahunan') {

            // set tahun
            $tahun = $data->data->tahun;

            return (

              // search by kode_retur + filter date tahunan
              supplier::where('kode_retur', 'LIKE', '%' . $search . '%')
              ->whereYear('tanggal', '=', $tahun)

              // search by nama_br + filter date tahunan
              ->orWhere('nama_br', 'LIKE', '%' . $search . '%')
              ->whereYear('tanggal', '=', $tahun)
            );
          }
        };

        // return model final
        return $dateType($data, $search)
          ->orderBy('created_at', 'desc')
          ->paginate(10);
      }

      // filter search
      if ($request->search !== null) {

        // set for return daraUrl
        $search = $request->search;

        return (
          // search by kode_retur
          supplier::where('kode_retur', 'LIKE', '%' . $search . '%')
          // search by nama_br
          ->orWhere('nama_br', 'LIKE', '%' . $search . '%')
          ->orderBy('created_at', 'desc')
          ->paginate(10));
      }

      // filter date
      if ($date !== null) {

        // data from filter date
        $data = json_decode(base64_decode($date));

        // set for dataUrl
        $ddate = $date;

        $dateType = function ($data) {
          if ($data->type === 'harian') {
            return (supplier::whereDate('tanggal', '=', $data->data)); // return filter date harian

          } elseif ($data->type === 'mingguan') {

            // set range date for between sql
            $start_date = Carbon::parse((string)$data->data)->startOfWeek();
            $end_date = Carbon::parse((string)$data->data)->endOfWeek();

            return (supplier::whereBetween('tanggal', [$start_date, $end_date])); // return filter date mingguan

          } elseif ($data->type === 'bulanan') {

            // set tahun & bulan
            $tahun = $data->data->tahun;
            $bulan = $data->data->bulan;

            return (
              // return filter date bulanan
              supplier::whereMonth('tanggal', '=', $bulan)
              ->whereYear('tanggal', '=', $tahun)
            );
          } elseif ($data->type === 'tahunan') {

            // set tahun
            $tahun = $data->data->tahun;

            // return filter date bulanan
            return (supplier::whereYear('tanggal', '=', $tahun)
            );
          } elseif ($data->type === 'range') {

            $date_awal = $data->data->awal;
            $date_akhir = $data->data->akhir;

            // return filter date range
            return (supplier::whereBetween('tanggal', [$date_awal, $date_akhir])
            );
          }
          // 2023-04-30'
        };

        return $dateType($data)
          ->orderBy('created_at', 'desc')
          ->paginate(10);
      }

      $search = "";
      $ddate = "";

      return supplier::orderBy('created_at', 'desc')
        ->paginate(10);
    };

    $dataRetur = $dataReturDB($request, $date);

    if ($request->has('search')) {
      $dataRetur->appends(array(
        'search' => $request->search
      ));
    }

    $dataUrl = array(
      "search" => $search,
      "date" => $ddate
    );

    return view("retur.riwayat", compact("dataRetur", "dataUrl"));
    // dd($dataRetur);
  }
}
