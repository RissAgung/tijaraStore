<?php

namespace App\Models;

use App\Models\pengeluaran\pengeluaran_pegawai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_pegawai extends Model
{
  use HasFactory;
  protected $table = 'pegawai'; // mendevinisikan nama table
  protected $primaryKey = 'kode_pegawai'; // mendevinisikan primary key
  public $incrementing = false; // auto pada primaryKey incremment false
  public $timestamps = false; // create_at dan update_at false

  protected $guarded = [];

  public function account()
  {
    return $this->hasOne(User::class, 'kode_pegawai', 'kode_pegawai');
  }

  public function pengeluaran_pegawai()
  {
    return $this->hasMany(pengeluaran_pegawai::class, 'kode_pegawai', 'kode_pegawai');
  }
}
