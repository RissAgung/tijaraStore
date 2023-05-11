<?php

namespace App\Http\Controllers;

use App\Models\akumulasi\pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Akumulasi extends Controller
{
  public function getPemasukan()
  {

    $bulan = [];
    $data = [];

    $result = pemasukan::select(
      DB::raw("CASE MONTH(tanggal)
                                          WHEN 1 THEN 'Januari'
                                          WHEN 2 THEN 'Februari'
                                          WHEN 3 THEN 'Maret'
                                          WHEN 4 THEN 'April'
                                          WHEN 5 THEN 'Mei'
                                          WHEN 6 THEN 'Juni'
                                          WHEN 7 THEN 'Juli'
                                          WHEN 8 THEN 'Agustus'
                                          WHEN 9 THEN 'September'
                                          WHEN 10 THEN 'Oktober'
                                          WHEN 11 THEN 'November'
                                          WHEN 12 THEN 'Desember'
                                        END AS bulan"),
      DB::raw("(SUM(bayar) - SUM(kembalian)) AS total")
    )
      ->whereYear('tanggal', now()->year)
      ->groupBy(DB::raw('MONTH(tanggal)'))
      ->groupBy('tanggal')
      ->get();

    foreach ($result as $index) {
      array_push($bulan, $index->bulan);
    }

    foreach ($result as $index) {
      array_push($data, $index->total);
    }

    return json_encode(
      array(
        "bulan" => $bulan,
        "data" => $data
      )
    );

    // return json_encode($result);
  }
}
