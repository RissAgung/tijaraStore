<?php

namespace App\Http\Controllers;

use App\Models\akumulasi\pemasukan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Akumulasi extends Controller
{
  public function getPemasukan(Request $request)
  {

    $label = [];
    $data = [];

    // filter date
    if ($request->data_date !== null) {

      $data_decode_date = json_decode(base64_decode($request->data_date));

      if ($data_decode_date->type === 'harian') {
        $result = pemasukan::select(
          DB::raw("CASE DATE_FORMAT(tanggal, '%W')
                        WHEN 'Sunday' THEN 'Minggu'
                        WHEN 'Monday' THEN 'Senin'
                        WHEN 'Tuesday' THEN 'Selasa'
                        WHEN 'Wednesday' THEN 'Rabu'
                        WHEN 'Thursday' THEN 'Kamis'
                        WHEN 'Friday' THEN 'Jumat'
                        WHEN 'Saturday' THEN 'Sabtu'
                    END AS hari"),
          DB::raw("(SUM(bayar) - SUM(kembalian)) AS total")
        )
          ->whereDate('tanggal', '=', $data_decode_date->data)
          ->groupBy('hari')
          ->get();

        foreach ($result as $index) {
          array_push($label, $index->hari);
        }

        foreach ($result as $index) {
          array_push($data, $index->total);
        }

        return json_encode(
          array(
            "label" => $label,
            "data" => $data
          )
        );
      } elseif ($data_decode_date->type === 'mingguan') {

        // set range date for between sql
        $start_date = Carbon::parse((string)$data_decode_date->data)->startOfWeek();
        $end_date = Carbon::parse((string)$data_decode_date->data)->endOfWeek();

        $result = pemasukan::selectRaw("
        CASE DATE_FORMAT(tanggal, '%W')
            WHEN 'Sunday' THEN 'Minggu'
            WHEN 'Monday' THEN 'Senin'
            WHEN 'Tuesday' THEN 'Selasa'
            WHEN 'Wednesday' THEN 'Rabu'
            WHEN 'Thursday' THEN 'Kamis'
            WHEN 'Friday' THEN 'Jumat'
            WHEN 'Saturday' THEN 'Sabtu'
       END AS hari")
          ->selectRaw("(SUM(bayar) - SUM(kembalian)) AS total")
          ->whereBetween('tanggal', [$start_date, $end_date])
          ->groupBy('hari')
          ->orderBy('hari', 'DESC')
          ->get();

        // foreach ($result as $index) {
        //   array_push($label, $index->hari);
        // }
        if (count($result) !== 0) {
          $label = [
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
          ];
          $data = [
            0, 0, 0, 0, 0, 0, 0
          ];
        }
        // foreach ($result as $index) {
        //   array_push($data, $index->total);
        // }



        foreach ($result as $index) {
          for ($i = 0; $i < count($label); $i++) {
            if ($label[$i] === $index->hari) {
              $data[$i] = $index->total;
            }
          }
        }


        // foreach ($result as $index) {
        //   for ($i = 0; $i < count($label); $i++) {
        //     if ($label[$i] === $index->hari) {
        //       array_push($data, $index->total);
        //     } else {
        //       array_push($data, 0);
        //     }
        //   }
        // }

        return json_encode(
          array(
            "label" => $label,
            "data" => $data,
            'date' => $start_date . '==' . $end_date
          )
        );
      } elseif ($data_decode_date->type === 'bulanan') {

        // set tahun & bulan
        $tahun = $data_decode_date->data->tahun;
        $bulan = $data_decode_date->data->bulan;

        $label = ["", "", "", "", "", "",];

        $yearweek = ["", "", "", "", "", "",];

        $data = [
          0, 0, 0, 0, 0, 0
        ];

        $mont = function ($month) {
          switch ($month) {
            case 1:
              return "Jan";
              break;
            case 2:
              return "Feb";
              break;
            case 3:
              return "Mar";
              break;
            case 4:
              return "Apr";
              break;
            case 5:
              return "Mei";
              break;
            case 6:
              return "Jun";
              break;
            case 7:
              return "Jul";
              break;
            case 8:
              return "Agu";
              break;
            case 9:
              return "Sep";
              break;
            case 10:
              return "Okt";
              break;
            case 11:
              return "Nov";
              break;
            case 12:
              return "Des";
              break;
          }
        };

        $query = "
        WITH RECURSIVE 
        Years(y) AS 
                (
                SELECT '" . $tahun . "'
                UNION ALL
                SELECT y + 1 FROM Years WHERE y < 2021
                ),
        Days (d) AS
                (
                SELECT 1
                UNION ALL
                SELECT d + 1 FROM Days WHERE d < 366
                )
        SELECT YEARWEEK(DATE(Min(MakeDate(y,d)))) as yearweek,
        y AS Year,
        MONTH(MakeDate(y,d)) AS Month,
        WEEK(MakeDate(y,d))+1 -WEEK(TIMESTAMPADD(MONTH,MONTH(MakeDate(y,d))-1,MakeDate(y,1))) AS Week,
        DAY(Min(MakeDate(y,d))) AS StartDate,
        DAY(DATE(timestampadd(second,-1,timestampadd(day,1,MAx(MakeDate(y,d)))))) AS EndDate, (CASE WHEN MONTHNAME(DATE(Min(MakeDate(y,d)))) = 'January' THEN 'Jan' WHEN MONTHNAME(DATE(Min(MakeDate(y,d)))) = 'February' THEN 'Feb' WHEN MONTHNAME(DATE(Min(MakeDate(y,d)))) = 'March' THEN 'Mar' WHEN MONTHNAME(DATE(Min(MakeDate(y,d)))) = 'April' THEN 'Apr' WHEN MONTHNAME(DATE(Min(MakeDate(y,d)))) = 'May' THEN 'Mei' WHEN MONTHNAME(DATE(Min(MakeDate(y,d)))) = 'June' THEN 'Jun' WHEN MONTHNAME(DATE(Min(MakeDate(y,d)))) = 'July' THEN 'Jul' WHEN MONTHNAME(DATE(Min(MakeDate(y,d)))) = 'August' THEN 'Aug' WHEN MONTHNAME(DATE(Min(MakeDate(y,d)))) = 'September' THEN 'Sep' WHEN MONTHNAME(DATE(Min(MakeDate(y,d)))) = 'October' THEN 'Oct' WHEN MONTHNAME(DATE(Min(MakeDate(y,d)))) = 'November' THEN 'Nov' WHEN MONTHNAME(DATE(Min(MakeDate(y,d)))) = 'December' THEN 'Dec' END) AS bulan
        FROM Years,Days
        WHERE MONTH(MakeDate(y,d)) = '" . $bulan . "' AND Year(MakeDate(y,d)) <= y 
        GROUP BY y, MONTH(MakeDate(y,d)),WEEK(MakeDate(y,d))+1 -WEEK(TIMESTAMPADD(MONTH,MONTH(MakeDate(y,d))-1,MakeDate(y,1)))
        ORDER BY 1,2,3";

        $WeekinThisMonth = DB::select($query);



        for ($i = 0; $i < count($WeekinThisMonth); $i++) {
          $label[$i] = $WeekinThisMonth[$i]->StartDate . '-' . $WeekinThisMonth[$i]->EndDate . ' ' . $mont($WeekinThisMonth[$i]->Month);
        }

        for ($i = 0; $i < count($WeekinThisMonth); $i++) {
          $yearweek[$i] = $WeekinThisMonth[$i]->yearweek;
        }

        $result = pemasukan::selectRaw('YEARWEEK(date(tanggal)) AS yearweek, (SUM(bayar) - SUM(kembalian)) AS total')
          ->whereMonth('tanggal', '=', $bulan)
          ->whereYear('tanggal', '=', $tahun)
          ->groupByRaw('YEARWEEK(date(tanggal))')
          ->get();

        foreach ($result as $index) {
          for ($i = 0; $i < count($yearweek); $i++) {
            if ($yearweek[$i] === $index->yearweek) {
              $data[$i] = $index->total;
            }
          }
        }

        // $data = DB::select((string)DB::raw($query));

        // Gunakan variabel $query sesuai kebutuhan Anda, misalnya:
        // $data = DB::select($query);

        return json_encode(
          array(
            "label" => $label,
            "data" => $data
          )
        );
      } elseif ($data_decode_date->type === 'tahunan') {

        // set tahun
        $tahun = $data_decode_date->data->tahun;

        $months = [
          'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
          'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        ];

        $results = DB::table('TRANSAKSI')
          ->selectRaw('MONTH(tanggal) AS bulan, (SUM(bayar) - SUM(kembalian)) AS total')
          ->whereYear('tanggal', $tahun)
          ->groupBy('bulan')
          ->orderBy('bulan')
          ->pluck('total', 'bulan');

        // Membuat koleksi dari hasil query
        $finalResults = collect($months)->map(function ($month, $index) use ($results) {
          $bulan_ke = $index + 1;
          $total = $results->get($bulan_ke, 0);

          return [
            'bulan' => $month,
            'total' => $total
          ];
        });

        foreach ($finalResults as $index) {
          array_push($data, $index['total']);
        }
        foreach ($finalResults as $index) {
          array_push($label, $index['bulan']);
        }


        return json_encode(
          array(
            "label" => $label,
            "data" => $data
          )
        );
      } elseif ($data_decode_date->type === 'range') {
        $date_awal = $data_decode_date->data->awal;
        $date_akhir = $data_decode_date->data->akhir;

        $result = pemasukan::whereBetween('tanggal', [$date_awal, $date_akhir])
          ->selectRaw('(SUM(bayar) - SUM(kembalian)) AS total')
          ->first()
          ->total;

        $label = [
          $date_awal . '-' . $date_akhir,
        ];
        // foreach ($result as $index) {
          array_push($data, (integer)$result);
        // }

        return json_encode(
          array(
            "label" => $label,
            "data" => $data
          )
        );
      }
    }


    $months = [
      'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
      'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
    ];

    $results = DB::table('TRANSAKSI')
      ->selectRaw('MONTH(tanggal) AS bulan, (SUM(bayar) - SUM(kembalian)) AS total')
      ->whereYear('tanggal', now()->year)
      ->groupBy('bulan')
      ->orderBy('bulan')
      ->pluck('total', 'bulan');

    // Membuat koleksi dari hasil query
    $finalResults = collect($months)->map(function ($month, $index) use ($results) {
      $bulan_ke = $index + 1;
      $total = $results->get($bulan_ke, 0);

      return [
        'bulan' => $month,
        'total' => $total
      ];
    });

    foreach ($finalResults as $index) {
      array_push($data, $index['total']);
    }
    foreach ($finalResults as $index) {
      array_push($label, $index['bulan']);
    }


    return json_encode(
      array(
        "label" => $label,
        "data" => $data
      )
    );


    // return json_encode($result);
  }
}
