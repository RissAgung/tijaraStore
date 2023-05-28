<?php

namespace App\Http\Controllers;

use App\Models\retur\customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class retur_customer extends Controller
{
  public function index(Request $request, $date = null)
  {
    $data_raw = function ($request, $date) {

      // search and date
      if ($request->has('search') && $date !== null) {
        $data = json_decode(base64_decode($date));
        $search = $request->search;

        // data for table
        $dateType = function ($data, $search) {
          if ($data->type === 'harian') {
            return customer::with('barangReturCS', 'barangKeluarReturCS')
              ->whereHas('barangReturCS', function ($query) use ($search) {
                $query->where('nama_br', 'LIKE', '%' . $search . '%');
              })
              ->whereDate('tanggal', '=', $data->data);
          } elseif ($data->type === 'mingguan') {

            // set range date for between sql
            $start_date = Carbon::parse((string)$data->data)->startOfWeek();
            $end_date = Carbon::parse((string)$data->data)->endOfWeek();

            return customer::with('barangReturCS', 'barangKeluarReturCS')
              ->whereHas('barangReturCS', function ($query) use ($search) {
                $query->where('nama_br', 'LIKE', '%' . $search . '%');
              })
              ->whereBetween('tanggal', [$start_date, $end_date]);
          } elseif ($data->type === 'bulanan') {

            // set tahun & bulan
            $tahun = $data->data->tahun;
            $bulan = $data->data->bulan;

            return (customer::with('barangReturCS', 'barangKeluarReturCS')
              ->whereHas('barangReturCS', function ($query) use ($search) {
                $query->where('nama_br', 'LIKE', '%' . $search . '%');
              })
              ->whereMonth('tanggal', '=', $bulan)
              ->whereYear('tanggal', '=', $tahun)
            );
          } elseif ($data->type === 'tahunan') {

            // set tahun
            $tahun = $data->data->tahun;

            // return filter date bulanan
            return customer::with('barangReturCS', 'barangKeluarReturCS')
              ->whereHas('barangReturCS', function ($query) use ($search) {
                $query->where('nama_br', 'LIKE', '%' . $search . '%');
              })
              ->whereYear('tanggal', '=', $tahun);
          } elseif ($data->type === 'range') {

            $date_awal = $data->data->awal;
            $date_akhir = $data->data->akhir . ' 23:59:59';

            // return filter date range
            return customer::with('barangReturCS', 'barangKeluarReturCS')
              ->whereHas('barangReturCS', function ($query) use ($search) {
                $query->where('nama_br', 'LIKE', '%' . $search . '%');
              })
              ->whereBetween('tanggal', [$date_awal, $date_akhir]);
          }
        };

        return $dateType($data, $search)
          ->orderBy('tanggal', 'desc')
          ->paginate(10);
      }

      // filter search
      if ($request->has('search')) {
        $search = $request->search;
        return customer::with('barangReturCS', 'barangKeluarReturCS')
          ->whereHas('barangReturCS', function ($query) use ($search) {
            $query->where('nama_br', 'LIKE', '%' . $search . '%');
          })
          ->orderBy('tanggal', 'desc')
          ->paginate(10);
      }

      // filter date
      if ($date !== null) {
        $data = json_decode(base64_decode($date));

        // data for table
        $dateType = function ($data) {
          if ($data->type === 'harian') {
            return customer::with('barangReturCS', 'barangKeluarReturCS')
              ->whereDate('tanggal', '=', $data->data);
          } elseif ($data->type === 'mingguan') {

            // set range date for between sql
            $start_date = Carbon::parse((string)$data->data)->startOfWeek();
            $end_date = Carbon::parse((string)$data->data)->endOfWeek();

            return customer::with('barangReturCS', 'barangKeluarReturCS')
              ->whereBetween('tanggal', [$start_date, $end_date]);
          } elseif ($data->type === 'bulanan') {

            // set tahun & bulan
            $tahun = $data->data->tahun;
            $bulan = $data->data->bulan;

            return (customer::with('barangReturCS', 'barangKeluarReturCS')
              ->whereMonth('tanggal', '=', $bulan)
              ->whereYear('tanggal', '=', $tahun)
            );
          } elseif ($data->type === 'tahunan') {

            // set tahun
            $tahun = $data->data->tahun;

            // return filter date bulanan
            return customer::with('barangReturCS', 'barangKeluarReturCS')
              ->whereYear('tanggal', '=', $tahun);
          } elseif ($data->type === 'range') {

            $date_awal = $data->data->awal;
            $date_akhir = $data->data->akhir . ' 23:59:59';

            // return filter date range
            return customer::with('barangReturCS', 'barangKeluarReturCS')
              ->whereBetween('tanggal', [$date_awal, $date_akhir]);
          }
        };

        return $dateType($data)
          ->orderBy('tanggal', 'desc')
          ->paginate(10);
      }

      return customer::with('barangReturCS', 'barangKeluarReturCS')
        ->orderBy('tanggal', 'desc')
        ->paginate(10);
    };

    $data = $data_raw($request, $date);

    if ($request->has('search')) {
      $data->appends(array(
        'search' => $request->search
      ));
    }

    $search = $request->search;


    return view('retur.riwayat_cus', compact('data', 'search'));
  }
}
