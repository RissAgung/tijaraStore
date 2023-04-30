<?php

namespace App\Models\retur;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
  use HasFactory;
  protected $table = 'RETUR_SUPPLIER'; // mendevinisikan nama table
  protected $primaryKey = 'kode_retur'; // mendevinisikan primary key
  public $incrementing = false; // auto pada primaryKey incremment false
  // public $timestamps = false; // create_at dan update_at false

  // fillable mendevinisikan field mana saja yang dapat kita isikan
  protected $guarded =[];
}
