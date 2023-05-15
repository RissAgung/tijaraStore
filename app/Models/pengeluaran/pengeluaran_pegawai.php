<?php

namespace App\Models\pengeluaran;

use App\Models\model_pegawai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengeluaran_pegawai extends Model
{
  use HasFactory;
  protected $table = 'PENGELUARAN_PEGAWAI'; // mendevinisikan nama table
  public $incrementing = false; // auto pada primaryKey incremment false
  public $timestamps = false; // create_at dan update_at false

  protected $guarded = [];

  public function pengeluaran()
  {
    return $this->belongsTo(pengeluaran::class, 'pegawai_pengeluaran', 'detail_pengeluaran_pegawai');
  }

  public function pegawai()
  {
    return $this->belongsTo(model_pegawai::class, 'kode_pegawai', 'kode_pegawai');
  }
}
