<?php

namespace App\Http\Controllers;

use App\Exports\ExportLaporanAkumulasi;
use App\Models\akumulasi\pemasukan;
use App\Models\pengeluaran\pengeluaran;
use App\Models\retur\customer;
use App\Models\retur\supplier;
use App\Models\riwayat\detail_transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class Akumulasi extends Controller
{
  public function getPemasukanPengeluaran(Request $request)
  {

    $label = [];
    $data = [];
    $data_pengeluaran = [];

    // filter date
    if ($request->data_date !== null) {

      $data_decode_date = json_decode(base64_decode($request->data_date));

      if ($data_decode_date->type === 'harian') {

        ////////////////////////////////// pemasukan //////////////////////////////////
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

        $result_retur_supp = supplier::select(
          DB::raw("CASE DATE_FORMAT(tanggal, '%W')
                          WHEN 'Sunday' THEN 'Minggu'
                          WHEN 'Monday' THEN 'Senin'
                          WHEN 'Tuesday' THEN 'Selasa'
                          WHEN 'Wednesday' THEN 'Rabu'
                          WHEN 'Thursday' THEN 'Kamis'
                          WHEN 'Friday' THEN 'Jumat'
                          WHEN 'Saturday' THEN 'Sabtu'
                      END AS hari"),
          DB::raw("SUM(jml_nominal) AS total")
        )
          ->where('jml_nominal', '>', 0)
          ->whereDate('tanggal', '=', $data_decode_date->data)
          ->groupBy('hari')
          ->get();

        $result_retur_cs = customer::select(
          DB::raw("CASE DATE_FORMAT(tanggal, '%W')
                            WHEN 'Sunday' THEN 'Minggu'
                            WHEN 'Monday' THEN 'Senin'
                            WHEN 'Tuesday' THEN 'Selasa'
                            WHEN 'Wednesday' THEN 'Rabu'
                            WHEN 'Thursday' THEN 'Kamis'
                            WHEN 'Friday' THEN 'Jumat'
                            WHEN 'Saturday' THEN 'Sabtu'
                        END AS hari"),
          DB::raw("SUM(bayar_kurang) AS total")
        )
          ->where('bayar_kurang', '>', 0)
          ->whereDate('tanggal', '=', $data_decode_date->data)
          ->groupBy('hari')
          ->get();

        $data_pemasukan = array();

        foreach ($result as $transaksi) {
          $tanggal = $transaksi->hari;
          $total = $transaksi->total;

          $data_pemasukan[$tanggal]['hari'] = $tanggal;
          $data_pemasukan[$tanggal]['total'] = $total;
        }

        // Menggabungkan array ke dalam data_pemasukan
        foreach ($result_retur_supp as $transaksi) {
          $tanggal = $transaksi->hari;
          $total = $transaksi->total;

          if (isset($data_pemasukan[$tanggal])) {
            // Jika tanggal sudah ada di data_pemasukan, tambahkan total harganya
            $data_pemasukan[$tanggal]['total'] += $total;
          } else {
            // Jika tanggal belum ada di data_pemasukan, tambahkan sebagai data baru
            $data_pemasukan[$tanggal]['hari'] = $tanggal;
            $data_pemasukan[$tanggal]['total'] = $total;
          }
        }

        foreach ($result_retur_cs as $transaksi) {
          $tanggal = $transaksi->hari;
          $total = $transaksi->total;

          if (isset($data_pemasukan[$tanggal])) {
            // Jika tanggal sudah ada di data_pemasukan, tambahkan total harganya
            $data_pemasukan[$tanggal]['total'] += $total;
          } else {
            // Jika tanggal belum ada di data_pemasukan, tambahkan sebagai data baru
            $data_pemasukan[$tanggal]['hari'] = $tanggal;
            $data_pemasukan[$tanggal]['total'] = $total;
          }
        }
        ////////////////////////////////// end pemasukan //////////////////////////////////

        ////////////////////////////////// pengeluaran //////////////////////////////////
        $result_pengeluaran = pengeluaran::select(
          DB::raw("CASE DATE_FORMAT(tanggal, '%W')
                        WHEN 'Sunday' THEN 'Minggu'
                        WHEN 'Monday' THEN 'Senin'
                        WHEN 'Tuesday' THEN 'Selasa'
                        WHEN 'Wednesday' THEN 'Rabu'
                        WHEN 'Thursday' THEN 'Kamis'
                        WHEN 'Friday' THEN 'Jumat'
                        WHEN 'Saturday' THEN 'Sabtu'
                    END AS hari"),
          DB::raw("(SUM(total)) AS total")
        )
          ->whereDate('tanggal', '=', $data_decode_date->data)
          ->groupBy('hari')
          ->get();

        $result_pengeluaran_cs = customer::select(
          DB::raw("CASE DATE_FORMAT(tanggal, '%W')
                          WHEN 'Sunday' THEN 'Minggu'
                          WHEN 'Monday' THEN 'Senin'
                          WHEN 'Tuesday' THEN 'Selasa'
                          WHEN 'Wednesday' THEN 'Rabu'
                          WHEN 'Thursday' THEN 'Kamis'
                          WHEN 'Friday' THEN 'Jumat'
                          WHEN 'Saturday' THEN 'Sabtu'
                      END AS hari"),
          DB::raw("(SUM(IFNULL(bayar_tunai, 0)) + SUM(IFNULL(kembalian_tunai, 0))) AS total")
        )
          ->where(function ($query) {
            $query->whereNotNull('kembalian_tunai')
              ->orWhereNotNull('bayar_tunai');
          })
          ->whereDate('tanggal', '=', $data_decode_date->data)
          ->groupBy('hari')
          ->get();


        $data_pengeluaran_raw = array();

        foreach ($result_pengeluaran as $transaksi) {
          $tanggal = $transaksi->hari;
          $total = $transaksi->total;

          $data_pengeluaran_raw[$tanggal]['hari'] = $tanggal;
          $data_pengeluaran_raw[$tanggal]['total'] = $total;
        }

        // Menggabungkan array ke dalam data_pemasukan
        foreach ($result_pengeluaran_cs as $transaksi) {
          $tanggal = $transaksi->hari;
          $total = $transaksi->total;

          if (isset($data_pengeluaran_raw[$tanggal])) {
            // Jika tanggal sudah ada di data_pemasukan, tambahkan total harganya
            $data_pengeluaran_raw[$tanggal]['total'] += $total;
          } else {
            // Jika tanggal belum ada di data_pemasukan, tambahkan sebagai data baru
            $data_pengeluaran_raw[$tanggal]['hari'] = $tanggal;
            $data_pengeluaran_raw[$tanggal]['total'] = $total;
          }
        }
        ////////////////////////////////// pengeluaran //////////////////////////////////

        if (count($data_pemasukan) > 0) {
          foreach ($data_pemasukan as $index) {
            array_push($label, $index['hari']);
          }
        } elseif (count($data_pengeluaran_raw) > 0) {
          foreach ($data_pengeluaran_raw as $index) {
            array_push($label, $index['hari']);
          }
        }

        foreach ($data_pemasukan as $index) {
          array_push($data, $index['total']);
        }

        foreach ($data_pengeluaran_raw as $index) {
          array_push($data_pengeluaran, $index['total']);
        }

        return json_encode(
          array(
            "label" => $label,
            "data" => $data,
            "data_pengeluaran" => $data_pengeluaran
          )
        );
      } elseif ($data_decode_date->type === 'mingguan') {

        // set range date for between sql
        $start_date = Carbon::parse((string)$data_decode_date->data)->startOfWeek();
        $end_date = Carbon::parse((string)$data_decode_date->data)->endOfWeek();

        ////////////////////////////////// pemasukan //////////////////////////////////

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

        $result_retur_supp = supplier::selectRaw("
        CASE DATE_FORMAT(tanggal, '%W')
            WHEN 'Sunday' THEN 'Minggu'
            WHEN 'Monday' THEN 'Senin'
            WHEN 'Tuesday' THEN 'Selasa'
            WHEN 'Wednesday' THEN 'Rabu'
            WHEN 'Thursday' THEN 'Kamis'
            WHEN 'Friday' THEN 'Jumat'
            WHEN 'Saturday' THEN 'Sabtu'
        END AS hari")
          ->selectRaw("SUM(jml_nominal) AS total")
          ->where('jml_nominal', '>', 0)
          ->whereBetween('tanggal', [$start_date, $end_date])
          ->groupBy('hari')
          ->orderBy('hari', 'DESC')
          ->get();

        $result_retur_cs = customer::selectRaw("
          CASE DATE_FORMAT(tanggal, '%W')
              WHEN 'Sunday' THEN 'Minggu'
              WHEN 'Monday' THEN 'Senin'
              WHEN 'Tuesday' THEN 'Selasa'
              WHEN 'Wednesday' THEN 'Rabu'
              WHEN 'Thursday' THEN 'Kamis'
              WHEN 'Friday' THEN 'Jumat'
              WHEN 'Saturday' THEN 'Sabtu'
          END AS hari")
          ->selectRaw("SUM(bayar_kurang) AS total")
          ->where('bayar_kurang', '>', 0)
          ->whereBetween('tanggal', [$start_date, $end_date])
          ->groupBy('hari')
          ->orderBy('hari', 'DESC')
          ->get();

        $data_pemasukan = array();

        foreach ($result as $transaksi) {
          $tanggal = $transaksi->hari;
          $total = $transaksi->total;

          $data_pemasukan[$tanggal]['hari'] = $tanggal;
          $data_pemasukan[$tanggal]['total'] = $total;
        }

        // Menggabungkan array ke dalam data_pemasukan
        foreach ($result_retur_supp as $transaksi) {
          $tanggal = $transaksi->hari;
          $total = $transaksi->total;

          if (isset($data_pemasukan[$tanggal])) {
            // Jika tanggal sudah ada di data_pemasukan, tambahkan total harganya
            $data_pemasukan[$tanggal]['total'] += $total;
          } else {
            // Jika tanggal belum ada di data_pemasukan, tambahkan sebagai data baru
            $data_pemasukan[$tanggal]['hari'] = $tanggal;
            $data_pemasukan[$tanggal]['total'] = $total;
          }
        }

        foreach ($result_retur_cs as $transaksi) {
          $tanggal = $transaksi->hari;
          $total = $transaksi->total;

          if (isset($data_pemasukan[$tanggal])) {
            // Jika tanggal sudah ada di data_pemasukan, tambahkan total harganya
            $data_pemasukan[$tanggal]['total'] += $total;
          } else {
            // Jika tanggal belum ada di data_pemasukan, tambahkan sebagai data baru
            $data_pemasukan[$tanggal]['hari'] = $tanggal;
            $data_pemasukan[$tanggal]['total'] = $total;
          }
        }

        ////////////////////////////////// end pemasukan //////////////////////////////////


        ////////////////////////////////// pengeluaran //////////////////////////////////

        $result = pengeluaran::selectRaw("
        CASE DATE_FORMAT(tanggal, '%W')
            WHEN 'Sunday' THEN 'Minggu'
            WHEN 'Monday' THEN 'Senin'
            WHEN 'Tuesday' THEN 'Selasa'
            WHEN 'Wednesday' THEN 'Rabu'
            WHEN 'Thursday' THEN 'Kamis'
            WHEN 'Friday' THEN 'Jumat'
            WHEN 'Saturday' THEN 'Sabtu'
       END AS hari")
          ->selectRaw("(SUM(total)) AS total")
          ->whereBetween('tanggal', [$start_date, $end_date])
          ->groupBy('hari')
          ->orderBy('hari', 'DESC')
          ->get();

        $result_pengeluaran_cs = customer::selectRaw("
        CASE DATE_FORMAT(tanggal, '%W')
            WHEN 'Sunday' THEN 'Minggu'
            WHEN 'Monday' THEN 'Senin'
            WHEN 'Tuesday' THEN 'Selasa'
            WHEN 'Wednesday' THEN 'Rabu'
            WHEN 'Thursday' THEN 'Kamis'
            WHEN 'Friday' THEN 'Jumat'
            WHEN 'Saturday' THEN 'Sabtu'
       END AS hari")
          ->selectRaw("(SUM(IFNULL(bayar_tunai, 0)) + SUM(IFNULL(kembalian_tunai, 0))) AS total")
          ->where(function ($query) {
            $query->whereNotNull('kembalian_tunai')
              ->orWhereNotNull('bayar_tunai');
          })
          ->whereBetween('tanggal', [$start_date, $end_date])
          ->groupBy('hari')
          ->orderBy('hari', 'DESC')
          ->get();

        $result_pengeluaran = array();

        foreach ($result as $transaksi) {
          $tanggal = $transaksi->hari;
          $total = $transaksi->total;

          $result_pengeluaran[$tanggal]['hari'] = $tanggal;
          $result_pengeluaran[$tanggal]['total'] = $total;
        }

        // Menggabungkan array ke dalam data_pemasukan
        foreach ($result_pengeluaran_cs as $transaksi) {
          $tanggal = $transaksi->hari;
          $total = $transaksi->total;

          if (isset($result_pengeluaran[$tanggal])) {
            // Jika tanggal sudah ada di data_pemasukan, tambahkan total harganya
            $result_pengeluaran[$tanggal]['total'] += $total;
          } else {
            // Jika tanggal belum ada di data_pemasukan, tambahkan sebagai data baru
            $result_pengeluaran[$tanggal]['hari'] = $tanggal;
            $result_pengeluaran[$tanggal]['total'] = $total;
          }
        }

        ////////////////////////////////// end pengeluaran //////////////////////////////////

        if (count($data_pemasukan) !== 0 || count($result_pengeluaran) !== 0) {
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
          $data_pengeluaran = [
            0, 0, 0, 0, 0, 0, 0
          ];
        }
        // foreach ($result as $index) {
        //   array_push($data, $index->total);
        // }




        foreach ($result_pengeluaran as $index) {
          for ($i = 0; $i < count($label); $i++) {
            if ($label[$i] === $index['hari']) {
              $data_pengeluaran[$i] = $index['total'];
            }
          }
        }

        foreach ($data_pemasukan as $index) {
          for ($i = 0; $i < count($label); $i++) {
            if ($label[$i] === $index['hari']) {
              $data[$i] = $index['total'];
            }
          }
        }

        // $p=array();
        // foreach($data_pemasukan as $index){
        //   array_push($p, $index['total']);
        // }

        return json_encode(
          array(
            "label" => $label,
            "data" => $data,
            "data_pengeluaran" => $data_pengeluaran,
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

        $data_pengeluaran = [
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

        ////////////////////////////////// pemasukan //////////////////////////////////
        $result = pemasukan::selectRaw('YEARWEEK(date(tanggal)) AS yearweek, (SUM(bayar) - SUM(kembalian)) AS total')
          ->whereMonth('tanggal', '=', $bulan)
          ->whereYear('tanggal', '=', $tahun)
          ->groupByRaw('YEARWEEK(date(tanggal))')
          ->get();

        $result_retur_supp = supplier::selectRaw('YEARWEEK(date(tanggal)) AS yearweek, SUM(jml_nominal) AS total')
          ->where('jml_nominal', '>', 0)
          ->whereMonth('tanggal', '=', $bulan)
          ->whereYear('tanggal', '=', $tahun)
          ->groupByRaw('YEARWEEK(date(tanggal))')
          ->get();

        $result_retur_cs = customer::selectRaw('YEARWEEK(date(tanggal)) AS yearweek, SUM(bayar_kurang) AS total')
          ->where('bayar_kurang', '>', 0)
          ->whereMonth('tanggal', '=', $bulan)
          ->whereYear('tanggal', '=', $tahun)
          ->groupByRaw('YEARWEEK(date(tanggal))')
          ->get();

        $data_pemasukan = array();

        foreach ($result as $transaksi) {
          $yearweek_raw = $transaksi->yearweek;
          $total = $transaksi->total;

          $data_pemasukan[$yearweek_raw]['yearweek'] = $yearweek_raw;
          $data_pemasukan[$yearweek_raw]['total'] = $total;
        }

        // Menggabungkan array ke dalam data_pemasukan
        foreach ($result_retur_supp as $transaksi) {
          $yearweek_raw = $transaksi->yearweek;
          $total = $transaksi->total;

          if (isset($data_pemasukan[$yearweek_raw])) {
            // Jika tanggal sudah ada di data_pemasukan, tambahkan total harganya
            $data_pemasukan[$yearweek_raw]['total'] += $total;
          } else {
            // Jika tanggal belum ada di data_pemasukan, tambahkan sebagai data baru
            $data_pemasukan[$yearweek_raw]['yearweek'] = $yearweek_raw;
            $data_pemasukan[$yearweek_raw]['total'] = $total;
          }
        }

        foreach ($result_retur_cs as $transaksi) {
          $yearweek_raw = $transaksi->yearweek;
          $total = $transaksi->total;

          if (isset($data_pemasukan[$yearweek_raw])) {
            // Jika tanggal sudah ada di data_pemasukan, tambahkan total harganya
            $data_pemasukan[$yearweek_raw]['total'] += $total;
          } else {
            // Jika tanggal belum ada di data_pemasukan, tambahkan sebagai data baru
            $data_pemasukan[$yearweek_raw]['yearweek'] = $yearweek_raw;
            $data_pemasukan[$yearweek_raw]['total'] = $total;
          }
        }
        ////////////////////////////////// end pemasukan //////////////////////////////////

        ////////////////////////////////// pengeluaran //////////////////////////////////
        $result = pengeluaran::selectRaw('YEARWEEK(date(tanggal)) AS yearweek, (SUM(total)) AS total')
          ->whereMonth('tanggal', '=', $bulan)
          ->whereYear('tanggal', '=', $tahun)
          ->groupByRaw('YEARWEEK(date(tanggal))')
          ->get();

        $result_pengeluaran_cs = customer::selectRaw("YEARWEEK(date(tanggal)) AS yearweek,(SUM(IFNULL(bayar_tunai, 0)) + SUM(IFNULL(kembalian_tunai, 0))) AS total")
          ->where(function ($query) {
            $query->whereNotNull('kembalian_tunai')
              ->orWhereNotNull('bayar_tunai');
          })
          ->whereMonth('tanggal', '=', $bulan)
          ->whereYear('tanggal', '=', $tahun)
          ->groupByRaw('YEARWEEK(date(tanggal))')
          ->get();

        $result_pengeluaran = array();

        foreach ($result as $transaksi) {
          $yearweek_raw = $transaksi->yearweek;
          $total = $transaksi->total;

          $result_pengeluaran[$yearweek_raw]['yearweek'] = $yearweek_raw;
          $result_pengeluaran[$yearweek_raw]['total'] = $total;
        }

        // Menggabungkan array ke dalam data_pemasukan
        foreach ($result_pengeluaran_cs as $transaksi) {
          $yearweek_raw = $transaksi->yearweek;
          $total = $transaksi->total;

          if (isset($result_pengeluaran[$yearweek_raw])) {
            $result_pengeluaran[$yearweek_raw]['total'] += $total;
          } else {
            $result_pengeluaran[$yearweek_raw]['yearweek'] = $yearweek_raw;
            $result_pengeluaran[$yearweek_raw]['total'] = $total;
          }
        }
        ////////////////////////////////// end pengeluaran //////////////////////////////////

        foreach ($data_pemasukan as $index) {
          for ($i = 0; $i < count($yearweek); $i++) {
            if ($yearweek[$i] === $index['yearweek']) {
              $data[$i] = $index['total'];
            }
          }
        }

        foreach ($result_pengeluaran as $index) {
          for ($i = 0; $i < count($yearweek); $i++) {
            if ($yearweek[$i] === $index['yearweek']) {
              $data_pengeluaran[$i] = $index['total'];
            }
          }
        }

        // $data = DB::select((string)DB::raw($query));

        // Gunakan variabel $query sesuai kebutuhan Anda, misalnya:
        // $data = DB::select($query);

        return json_encode(
          array(
            "label" => $label,
            "data" => $data,
            "data_pengeluaran" => $data_pengeluaran
          )
        );
      } elseif ($data_decode_date->type === 'tahunan') {

        // set tahun
        $tahun = $data_decode_date->data->tahun;

        $label = [
          'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
          'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        ];
        $data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $data_pengeluaran = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

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

        ////////////////////////////////// pemasukan //////////////////////////////////

        $results = DB::table('transaksi')
          ->selectRaw('MONTH(tanggal) AS bulan, (SUM(bayar) - SUM(kembalian)) AS total')
          ->whereYear('tanggal', $tahun)
          ->groupBy('bulan')
          ->orderBy('bulan')
          ->get();

        $result_retur_supp = supplier::selectRaw('MONTH(tanggal) AS bulan, SUM(jml_nominal) AS total')
          ->where('jml_nominal', '>', 0)
          ->whereYear('tanggal', $tahun)
          ->groupBy('bulan')
          ->orderBy('bulan')
          ->get();

        $result_retur_cs = customer::selectRaw('MONTH(tanggal) AS bulan, SUM(bayar_kurang) AS total')
          ->where('bayar_kurang', '>', 0)
          ->whereYear('tanggal', $tahun)
          ->groupBy('bulan')
          ->orderBy('bulan')
          ->get();

        $data_pemasukan = array();

        foreach ($results as $transaksi) {
          $tanggal = $transaksi->bulan;
          $total = $transaksi->total;

          $data_pemasukan[$tanggal]['bulan'] = $tanggal;
          $data_pemasukan[$tanggal]['total'] = $total;
        }

        // Menggabungkan array ke dalam data_pemasukan
        foreach ($result_retur_supp as $transaksi) {
          $tanggal = $transaksi->bulan;
          $total = $transaksi->total;

          if (isset($data_pemasukan[$tanggal])) {
            // Jika tanggal sudah ada di data_pemasukan, tambahkan total harganya
            $data_pemasukan[$tanggal]['total'] += $total;
          } else {
            // Jika tanggal belum ada di data_pemasukan, tambahkan sebagai data baru
            $data_pemasukan[$tanggal]['bulan'] = $tanggal;
            $data_pemasukan[$tanggal]['total'] = $total;
          }
        }

        foreach ($result_retur_cs as $transaksi) {
          $tanggal = $transaksi->bulan;
          $total = $transaksi->total;

          if (isset($data_pemasukan[$tanggal])) {
            // Jika tanggal sudah ada di data_pemasukan, tambahkan total harganya
            $data_pemasukan[$tanggal]['total'] += $total;
          } else {
            // Jika tanggal belum ada di data_pemasukan, tambahkan sebagai data baru
            $data_pemasukan[$tanggal]['bulan'] = $tanggal;
            $data_pemasukan[$tanggal]['total'] = $total;
          }
        }

        ////////////////////////////////// end pemasukan //////////////////////////////////

        ////////////////////////////////// pengeluaran //////////////////////////////////
        $results_pengeluaran = pengeluaran::selectRaw('MONTH(tanggal) AS bulan, (SUM(total)) AS total')
          ->whereYear('tanggal', $tahun)
          ->groupBy('bulan')
          ->orderBy('bulan')
          ->get();

        $results_pengeluaran_cs = customer::selectRaw('MONTH(tanggal) AS bulan, (SUM(IFNULL(bayar_tunai, 0)) + SUM(IFNULL(kembalian_tunai, 0))) AS total')
          ->where(function ($query) {
            $query->whereNotNull('kembalian_tunai')
              ->orWhereNotNull('bayar_tunai');
          })
          ->whereYear('tanggal', $tahun)
          ->groupBy('bulan')
          ->orderBy('bulan')
          ->get();

        $data_pengeluaran_raw = array();

        foreach ($results_pengeluaran as $transaksi) {
          $tanggal = $transaksi->bulan;
          $total = $transaksi->total;

          $data_pengeluaran_raw[$tanggal]['bulan'] = $tanggal;
          $data_pengeluaran_raw[$tanggal]['total'] = $total;
        }

        // Menggabungkan array ke dalam data_pemasukan
        foreach ($results_pengeluaran_cs as $transaksi) {
          $tanggal = $transaksi->bulan;
          $total = $transaksi->total;

          if (isset($data_pengeluaran_raw[$tanggal])) {
            // Jika tanggal sudah ada di data_pemasukan, tambahkan total harganya
            $data_pengeluaran_raw[$tanggal]['total'] += $total;
          } else {
            // Jika tanggal belum ada di data_pemasukan, tambahkan sebagai data baru
            $data_pengeluaran_raw[$tanggal]['bulan'] = $tanggal;
            $data_pengeluaran_raw[$tanggal]['total'] = $total;
          }
        }
        ////////////////////////////////// end pengeluaran //////////////////////////////////

        foreach ($data_pemasukan as $index) {
          for ($i = 0; $i < count($label); $i++) {
            if ($label[$i] === $mont($index['bulan'])) {
              $data[$i] = $index['total'];
            }
          }
        }

        foreach ($data_pengeluaran_raw as $index) {
          for ($i = 0; $i < count($label); $i++) {
            if ($label[$i] === $mont($index['bulan'])) {
              $data_pengeluaran[$i] = $index['total'];
            }
          }
        }

        return json_encode(
          array(
            "label" => $label,
            "data" => $data,
            "data_pengeluaran" => $data_pengeluaran
          )
        );
      } elseif ($data_decode_date->type === 'range') {
        $date_awal = $data_decode_date->data->awal;
        $date_akhir = $data_decode_date->data->akhir;

        ////////////////////////////////// pemasukan //////////////////////////////////
        $result = pemasukan::whereBetween('tanggal', [$date_awal, $date_akhir . ' 23:59:00'])
          ->selectRaw('(SUM(bayar) - SUM(kembalian)) AS total')
          ->first()
          ->total;

        $result_retur_supp = supplier::where('jml_nominal', '>', 0)
          ->whereBetween('tanggal', [$date_awal, $date_akhir . ' 23:59:00'])
          ->selectRaw('SUM(jml_nominal)AS total')
          ->first()
          ->total;

        $result_retur_cs = customer::where('bayar_kurang', '>', 0)
          ->whereBetween('tanggal', [$date_awal, $date_akhir . ' 23:59:00'])
          ->selectRaw('SUM(bayar_kurang) AS total')
          ->first()
          ->total;

        $result_pemasukan = $result + $result_retur_supp + $result_retur_cs;
        ////////////////////////////////// end pemasukan //////////////////////////////////

        ////////////////////////////////// pengeluaran //////////////////////////////////
        $result_pengeluaran_raw = pengeluaran::whereBetween('tanggal', [$date_awal, $date_akhir . ' 23:59:00'])
          ->selectRaw('(SUM(total)) AS total')
          ->first()
          ->total;
        $result_pengeluaran_cs = customer::whereBetween('tanggal', [$date_awal, $date_akhir . ' 23:59:00'])
          ->selectRaw('(SUM(IFNULL(bayar_tunai, 0)) + SUM(IFNULL(kembalian_tunai, 0))) AS total')
          ->where(function ($query) {
            $query->whereNotNull('kembalian_tunai')
              ->orWhereNotNull('bayar_tunai');
          })
          ->first()
          ->total;

        $result_pengeluaran = $result_pengeluaran_raw + $result_pengeluaran_cs;
        ////////////////////////////////// end pengeluaran //////////////////////////////////

        $label = [
          $date_awal . ' / ' . $date_akhir,
        ];
        // foreach ($result as $index) {
        array_push($data, (int)$result_pemasukan);
        array_push($data_pengeluaran, (int)$result_pengeluaran);
        // }

        return json_encode(
          array(
            "label" => $label,
            "data" => $data,
            "data_pengeluaran" => $data_pengeluaran
          )
        );
      }
    }
    // end filter date

    ////////////////////////////////// default view //////////////////////////////////

    $label = [
      'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
      'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
    ];
    $data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    $data_pengeluaran = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

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

    ////////////////////////////////// pemasukan //////////////////////////////////

    $results = DB::table('transaksi')
      ->selectRaw('MONTH(tanggal) AS bulan, (SUM(bayar) - SUM(kembalian)) AS total')
      ->whereYear('tanggal', now()->year)
      ->groupBy('bulan')
      ->orderBy('bulan')
      ->get();

    $result_retur_supp = supplier::selectRaw('MONTH(tanggal) AS bulan, SUM(jml_nominal) AS total')
      ->where('jml_nominal', '>', 0)
      ->whereYear('tanggal', now()->year)
      ->groupBy('bulan')
      ->orderBy('bulan')
      ->get();

    $result_retur_cs = customer::selectRaw('MONTH(tanggal) AS bulan, SUM(bayar_kurang) AS total')
      ->where('bayar_kurang', '>', 0)
      ->whereYear('tanggal', now()->year)
      ->groupBy('bulan')
      ->orderBy('bulan')
      ->get();

    $data_pemasukan = array();

    foreach ($results as $transaksi) {
      $tanggal = $transaksi->bulan;
      $total = $transaksi->total;

      $data_pemasukan[$tanggal]['bulan'] = $tanggal;
      $data_pemasukan[$tanggal]['total'] = $total;
    }

    // Menggabungkan array ke dalam data_pemasukan
    foreach ($result_retur_supp as $transaksi) {
      $tanggal = $transaksi->bulan;
      $total = $transaksi->total;

      if (isset($data_pemasukan[$tanggal])) {
        // Jika tanggal sudah ada di data_pemasukan, tambahkan total harganya
        $data_pemasukan[$tanggal]['total'] += $total;
      } else {
        // Jika tanggal belum ada di data_pemasukan, tambahkan sebagai data baru
        $data_pemasukan[$tanggal]['bulan'] = $tanggal;
        $data_pemasukan[$tanggal]['total'] = $total;
      }
    }

    foreach ($result_retur_cs as $transaksi) {
      $tanggal = $transaksi->bulan;
      $total = $transaksi->total;

      if (isset($data_pemasukan[$tanggal])) {
        // Jika tanggal sudah ada di data_pemasukan, tambahkan total harganya
        $data_pemasukan[$tanggal]['total'] += $total;
      } else {
        // Jika tanggal belum ada di data_pemasukan, tambahkan sebagai data baru
        $data_pemasukan[$tanggal]['bulan'] = $tanggal;
        $data_pemasukan[$tanggal]['total'] = $total;
      }
    }

    ////////////////////////////////// end pemasukan //////////////////////////////////

    ////////////////////////////////// pengeluaran //////////////////////////////////
    $results_pengeluaran = pengeluaran::selectRaw('MONTH(tanggal) AS bulan, (SUM(total)) AS total')
      ->whereYear('tanggal', now()->year)
      ->groupBy('bulan')
      ->orderBy('bulan')
      ->get();

    $results_pengeluaran_cs = customer::selectRaw('MONTH(tanggal) AS bulan, (SUM(IFNULL(bayar_tunai, 0)) + SUM(IFNULL(kembalian_tunai, 0))) AS total')
      ->where(function ($query) {
        $query->whereNotNull('kembalian_tunai')
          ->orWhereNotNull('bayar_tunai');
      })
      ->whereYear('tanggal', now()->year)
      ->groupBy('bulan')
      ->orderBy('bulan')
      ->get();

    $data_pengeluaran_raw = array();

    foreach ($results_pengeluaran as $transaksi) {
      $tanggal = $transaksi->bulan;
      $total = $transaksi->total;

      $data_pengeluaran_raw[$tanggal]['bulan'] = $tanggal;
      $data_pengeluaran_raw[$tanggal]['total'] = $total;
    }

    // Menggabungkan array ke dalam data_pemasukan
    foreach ($results_pengeluaran_cs as $transaksi) {
      $tanggal = $transaksi->bulan;
      $total = $transaksi->total;

      if (isset($data_pengeluaran_raw[$tanggal])) {
        // Jika tanggal sudah ada di data_pemasukan, tambahkan total harganya
        $data_pengeluaran_raw[$tanggal]['total'] += $total;
      } else {
        // Jika tanggal belum ada di data_pemasukan, tambahkan sebagai data baru
        $data_pengeluaran_raw[$tanggal]['bulan'] = $tanggal;
        $data_pengeluaran_raw[$tanggal]['total'] = $total;
      }
    }
    ////////////////////////////////// end pengeluaran //////////////////////////////////

    foreach ($data_pemasukan as $index) {
      for ($i = 0; $i < count($label); $i++) {
        if ($label[$i] === $mont($index['bulan'])) {
          $data[$i] = $index['total'];
        }
      }
    }

    foreach ($data_pengeluaran_raw as $index) {
      for ($i = 0; $i < count($label); $i++) {
        if ($label[$i] === $mont($index['bulan'])) {
          $data_pengeluaran[$i] = $index['total'];
        }
      }
    }

    return json_encode(
      array(
        "label" => $label,
        "data" => $data,
        "data_pengeluaran" => $data_pengeluaran
      )
    );

    ////////////////////////////////// end default view //////////////////////////////////
  }

  public function getDataPie(Request $request)
  {


    $query = function ($request) {

      if ($request->data_date !== null) {

        $data_decode_date = json_decode(base64_decode($request->data_date));

        if ($data_decode_date->type === 'harian') { //HARIAN

          return "SELECT kategori, nama_br, harga, jumlah
            FROM (
                SELECT barang.kategori, barang.nama_br, barang.harga, SUM(detail_transaksi.QTY) as jumlah,
                    ROW_NUMBER() OVER (PARTITION BY barang.kategori ORDER BY barang.nama_br) AS row_num
                FROM detail_transaksi
                JOIN transaksi ON transaksi.kode_tr = detail_transaksi.kode_tr
                JOIN barang ON detail_transaksi.kode_br = barang.kode_br
                WHERE DATE(transaksi.tanggal) = '" . $data_decode_date->data . "'
                GROUP BY barang.nama_br, barang.kategori, barang.harga
            ) AS subquery
            WHERE row_num <= 5
            ORDER BY kategori, nama_br;";
        } elseif ($data_decode_date->type === 'mingguan') { //MINGGUAN

          // set range date for between sql
          $start_date = Carbon::parse((string)$data_decode_date->data)->startOfWeek();
          $end_date = Carbon::parse((string)$data_decode_date->data)->endOfWeek();

          return "SELECT kategori, nama_br, harga, jumlah
            FROM (
                SELECT barang.kategori, barang.nama_br, barang.harga, SUM(detail_transaksi.QTY) as jumlah,
                    ROW_NUMBER() OVER (PARTITION BY barang.kategori ORDER BY barang.nama_br) AS row_num
                FROM detail_transaksi
                JOIN transaksi ON transaksi.kode_tr = detail_transaksi.kode_tr
                JOIN barang ON detail_transaksi.kode_br = barang.kode_br
                WHERE tanggal BETWEEN '" . $start_date . "' AND '" . $end_date . "'
                GROUP BY barang.nama_br, barang.kategori, barang.harga
            ) AS subquery
            WHERE row_num <= 5
            ORDER BY kategori, nama_br;";
        } elseif ($data_decode_date->type === 'bulanan') { //BULANAN

          // set tahun & bulan
          $tahun = $data_decode_date->data->tahun;
          $bulan = $data_decode_date->data->bulan;

          return "SELECT kategori, nama_br, harga, jumlah
            FROM (
                SELECT barang.kategori, barang.nama_br, barang.harga, SUM(detail_transaksi.QTY) as jumlah,
                    ROW_NUMBER() OVER (PARTITION BY barang.kategori ORDER BY barang.nama_br) AS row_num
                FROM detail_transaksi
                JOIN transaksi ON transaksi.kode_tr = detail_transaksi.kode_tr
                JOIN barang ON detail_transaksi.kode_br = barang.kode_br
                WHERE YEAR(tanggal) = '" . $tahun . "' AND MONTH(tanggal) = '" . $bulan . "'
                GROUP BY barang.nama_br, barang.kategori, barang.harga
            ) AS subquery
            WHERE row_num <= 5
            ORDER BY kategori, nama_br;";
        } elseif ($data_decode_date->type === 'tahunan') { //TAHUNAN

          // set tahun
          $tahun = $data_decode_date->data->tahun;

          return "SELECT kategori, nama_br, harga, jumlah
            FROM (
                SELECT barang.kategori, barang.nama_br, barang.harga, SUM(detail_transaksi.QTY) as jumlah,
                    ROW_NUMBER() OVER (PARTITION BY barang.kategori ORDER BY barang.nama_br) AS row_num
                FROM detail_transaksi
                JOIN transaksi ON transaksi.kode_tr = detail_transaksi.kode_tr
                JOIN barang ON detail_transaksi.kode_br = barang.kode_br
                WHERE YEAR(tanggal) = '" . $tahun . "'
                GROUP BY barang.nama_br, barang.kategori, barang.harga
            ) AS subquery
            WHERE row_num <= 5
            ORDER BY kategori, nama_br;";
        } elseif ($data_decode_date->type === 'range') { //RANGE
          $date_awal = $data_decode_date->data->awal;
          $date_akhir = $data_decode_date->data->akhir . ' 23:59:00';

          return "SELECT kategori, nama_br, harga, jumlah
            FROM (
                SELECT barang.kategori, barang.nama_br, barang.harga, SUM(detail_transaksi.QTY) as jumlah,
                    ROW_NUMBER() OVER (PARTITION BY barang.kategori ORDER BY barang.nama_br) AS row_num
                FROM detail_transaksi
                JOIN transaksi ON transaksi.kode_tr = detail_transaksi.kode_tr
                JOIN barang ON detail_transaksi.kode_br = barang.kode_br
                WHERE tanggal BETWEEN '" . $date_awal . "' AND '" . $date_akhir . "'
                GROUP BY barang.nama_br, barang.kategori, barang.harga
            ) AS subquery
            WHERE row_num <= 5
            ORDER BY kategori, nama_br;";
        }
      }

      return "SELECT kategori, nama_br, harga, jumlah
      FROM (
          SELECT barang.kategori, barang.nama_br, barang.harga, SUM(detail_transaksi.QTY) as jumlah,
              ROW_NUMBER() OVER (PARTITION BY barang.kategori ORDER BY barang.nama_br) AS row_num
          FROM detail_transaksi
          JOIN transaksi ON transaksi.kode_tr = detail_transaksi.kode_tr
          JOIN barang ON detail_transaksi.kode_br = barang.kode_br
          WHERE YEAR(transaksi.tanggal) = '" . now()->year . "'
          GROUP BY barang.nama_br, barang.kategori, barang.harga
      ) AS subquery
      WHERE row_num <= 5
      ORDER BY kategori, nama_br;";
    };

    $result = DB::select($query($request));


    $Seriespria = array();
    $Labelspria = array();

    $Serieswanita = array();
    $Labelswanita = array();

    $Seriesanak = array();
    $Labelsanak = array();

    foreach ($result as $index) {
      if ($index->kategori === 'pria') {
        $nama = $index->nama_br;
        $jumlah = (int)$index->jumlah;

        array_push($Labelspria, $nama);
        array_push($Seriespria, $jumlah);
      }
      if ($index->kategori === 'wanita') {
        $nama = $index->nama_br;
        $jumlah = (int)$index->jumlah;

        array_push($Labelswanita, $nama);
        array_push($Serieswanita, $jumlah);
      }
      if ($index->kategori === 'anak') {
        $nama = $index->nama_br;
        $jumlah = (int)$index->jumlah;

        array_push($Labelsanak, $nama);
        array_push($Seriesanak, $jumlah);
      }
    }

    return json_encode(
      array(
        "pria" => array(
          'series' => $Seriespria,
          'labels' => $Labelspria
        ),
        "wanita" => array(
          'series' => $Serieswanita,
          'labels' => $Labelswanita
        ),
        "anak" => array(
          'series' => $Seriesanak,
          'labels' => $Labelsanak
        ),
      )
    );
  }

  public function export(Request $request)
  {
    return Excel::download(new ExportLaporanAkumulasi($request), 'laporan_akumulasi.xlsx');
  }
}
