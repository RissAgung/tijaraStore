<?php

namespace App\Models\retur;

use App\Models\supplier as ModelsSupplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
  use HasFactory;
  protected $table = 'retur_supplier'; // mendevinisikan nama table
  protected $primaryKey = 'kode_retur'; // mendevinisikan primary key
  public $incrementing = false; // auto pada primaryKey incremment false
  // public $timestamps = false; // create_at dan update_at false

  // fillable mendevinisikan field mana saja yang dapat kita isikan
  protected $guarded =[];
}
