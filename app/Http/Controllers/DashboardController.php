<?php

namespace App\Http\Controllers;

use App\Models\akumulasi\pemasukan;
use App\Models\pengeluaran\pengeluaran;
use App\Models\products\barang;
use App\Models\retur\customer;
use App\Models\retur\supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  public function index()
  {

    $product = barang::where('stok', '<', 5)->get();
    $data_chart = $this->getChart();
    $data_pie_chart = $this->getPieChart();

    return view('dashboard', compact('product', 'data_chart', 'data_pie_chart'));
  }

  function getChart()
  {
    // set tahun & bulan
    $tahun = now()->year;
    $bulan = date('m');

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

    return base64_encode(json_encode(
      array(
        "label" => $label,
        "data" => $data,
        "data_pengeluaran" => $data_pengeluaran
      )
    ));
  }

  function getPieChart()
  {
    // set tahun & bulan
    $tahun = now()->year;
    $bulan = date('m');

    $query = "SELECT kategori, nama_br, harga, jumlah
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

    $result = DB::select($query);


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

    return base64_encode(
      json_encode(
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
      )
    );
  }
}
