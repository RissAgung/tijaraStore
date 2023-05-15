<?php

namespace App\Models\pengeluaran;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengeluaran extends Model
{
  use HasFactory;
  protected $table = 'PENGELUARAN'; // mendevinisikan nama table
  protected $primaryKey = 'kode_pengeluaran'; // mendevinisikan primary key
  public $incrementing = false; // auto pada primaryKey incremment false
  public $timestamps = false; // create_at dan update_at false

  protected $guarded = [];

  public static function getJumlahTotalOperasional($filter)
  {

    // has filter date
    if ($filter !== null) {

      // harian 
      if ($filter->type === 'harian') {

        return self::selectRaw('SUM(total) as jumlah_total')
          ->where('jenis_pengeluaran', 'operasional')
          ->whereDate('tanggal', '=', $filter->data)
          ->get();
      } elseif ($filter->type === 'mingguan') {

        // set range date for between sql
        $start_date = Carbon::parse((string)$filter->data)->startOfWeek();
        $end_date = Carbon::parse((string)$filter->data)->endOfWeek();

        // return mingguan
        return self::selectRaw('SUM(total) as jumlah_total')
          ->where('jenis_pengeluaran', 'operasional')
          ->whereBetween('tanggal', [$start_date, $end_date])
          ->get();
      } elseif ($filter->type === 'bulanan') {

        // set tahun & bulan
        $tahun = $filter->data->tahun;
        $bulan = $filter->data->bulan;

        // return bulan
        return self::selectRaw('SUM(total) as jumlah_total')
          ->where('jenis_pengeluaran', 'operasional')
          ->whereMonth('tanggal', '=', $bulan)
          ->whereYear('tanggal', '=', $tahun)
          ->get();
      } elseif ($filter->type === 'tahunan') {

        // set tahun
        $tahun = $filter->data->tahun;

        // return filter date bulanan
        return self::selectRaw('SUM(total) as jumlah_total')
          ->where('jenis_pengeluaran', 'operasional')
          ->whereYear('tanggal', '=', $tahun)
          ->get();
      } elseif ($filter->type === 'range') {

        // set range
        $date_awal = $filter->data->awal;
        $date_akhir = $filter->data->akhir;

        // return range
        return self::selectRaw('SUM(total) as jumlah_total')
          ->where('jenis_pengeluaran', 'operasional')
          ->whereBetween('tanggal', [$date_awal, $date_akhir])
          ->get();
      }
    }

    return self::selectRaw('SUM(total) as jumlah_total')
      ->where('jenis_pengeluaran', 'operasional')
      ->whereDate('tanggal', '=', Carbon::now())
      ->get();
  }

  public static function getJumlahTotalRestock($filter)
  {
    // has filter date
    if ($filter !== null) {

      // harian 
      if ($filter->type === 'harian') {

        return self::selectRaw('SUM(total) as jumlah_total')
          ->where('jenis_pengeluaran', 'restock')
          ->whereDate('tanggal', '=', $filter->data)
          ->get();
      } elseif ($filter->type === 'mingguan') {

        // set range date for between sql
        $start_date = Carbon::parse((string)$filter->data)->startOfWeek();
        $end_date = Carbon::parse((string)$filter->data)->endOfWeek();

        // return mingguan
        return self::selectRaw('SUM(total) as jumlah_total')
          ->where('jenis_pengeluaran', 'restock')
          ->whereBetween('tanggal', [$start_date, $end_date])
          ->get();
      } elseif ($filter->type === 'bulanan') {

        // set tahun & bulan
        $tahun = $filter->data->tahun;
        $bulan = $filter->data->bulan;

        // return bulan
        return self::selectRaw('SUM(total) as jumlah_total')
          ->where('jenis_pengeluaran', 'restock')
          ->whereMonth('tanggal', '=', $bulan)
          ->whereYear('tanggal', '=', $tahun)
          ->get();
      } elseif ($filter->type === 'tahunan') {

        // set tahun
        $tahun = $filter->data->tahun;

        // return filter date bulanan
        return self::selectRaw('SUM(total) as jumlah_total')
          ->where('jenis_pengeluaran', 'restock')
          ->whereYear('tanggal', '=', $tahun)
          ->get();
      } elseif ($filter->type === 'range') {

        // set range
        $date_awal = $filter->data->awal;
        $date_akhir = $filter->data->akhir;

        // return range
        return self::selectRaw('SUM(total) as jumlah_total')
          ->where('jenis_pengeluaran', 'restock')
          ->whereBetween('tanggal', [$date_awal, $date_akhir])
          ->get();
      }
    }

    return self::selectRaw('SUM(total) as jumlah_total')
      ->where('jenis_pengeluaran', 'restock')
      ->whereDate('tanggal', '=', Carbon::now())
      ->get();
  }

  public function pengeluaran_pegawai()
  {
    return $this->hasOne(pengeluaran_pegawai::class, 'pegawai_pengeluaran', 'detail_pengeluaran_pegawai');
  }
}
