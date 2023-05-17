<?php

namespace App\Models\akumulasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pemasukan extends Model
{
  use HasFactory;
  protected $table = 'TRANSAKSI'; // mendevinisikan nama table
  protected $primaryKey = 'kode_tr'; // mendevinisikan primary key
  public $incrementing = false; // auto pada primaryKey incremment false
  public $timestamps = false; // create_at dan update_at false

  // fillable mendevinisikan field mana saja yang dapat kita isikan
  protected $guarded = [];

  static function getMingguDalamSebulan()
  {
    return DB::table('your_table AS Years, your_table AS Days')
      ->selectRaw('YEARWEEK(MakeDate(y, d)) AS yearweek')
      ->selectRaw('y AS Year')
      ->selectRaw('MONTH(MakeDate(y, d)) AS Month')
      ->selectRaw('WEEK(MakeDate(y, d)) + 1 - WEEK(TIMESTAMPADD(MONTH, MONTH(MakeDate(y, d)) - 1, MakeDate(y, 1))) AS Week')
      ->selectRaw('DATE_FORMAT(MIN(MakeDate(y, d)), "%e") AS StartDate')
      ->selectRaw('DATE_FORMAT(TIMESTAMPADD(SECOND, -1, TIMESTAMPADD(DAY, 1, MAX(MakeDate(y, d)))), "%e") AS EndDate')
      ->whereRaw('MONTH(MakeDate(y, d)) = ?', [4])
      ->whereRaw('YEAR(MakeDate(y, d)) <= y')
      ->groupBy('y', 'MONTH(MakeDate(y, d))', 'WEEK(MakeDate(y, d)) + 1 - WEEK(TIMESTAMPADD(MONTH, MONTH(MakeDate(y, d)) - 1, MakeDate(y, 1)))')
      ->orderByRaw('1, 2, 3')
      ->get();
  }
}
