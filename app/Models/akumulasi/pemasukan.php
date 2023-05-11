<?php

namespace App\Models\akumulasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemasukan extends Model
{
  use HasFactory;
  protected $table = 'TRANSAKSI'; // mendevinisikan nama table
  protected $primaryKey = 'kode_tr'; // mendevinisikan primary key
  public $incrementing = false; // auto pada primaryKey incremment false
  public $timestamps = false; // create_at dan update_at false

  // fillable mendevinisikan field mana saja yang dapat kita isikan
  protected $guarded = [];
}
