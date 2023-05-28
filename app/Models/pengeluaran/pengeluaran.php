<?php

namespace App\Models\pengeluaran;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pengeluaran extends Model
{
    use HasFactory;
    protected $table = 'pengeluaran'; // mendevinisikan nama table
    protected $primaryKey = 'kode_pengeluaran'; // mendevinisikan primary key
    public $incrementing = false; // auto pada primaryKey incremment false
    public $timestamps = false; // create_at dan update_at false

    protected $guarded = [];

  public function pengeluaran_pegawai()
  {
    return $this->hasOne(pengeluaran_pegawai::class, 'pegawai_pengeluaran', 'detail_pengeluaran_pegawai');
  }

  public function pengeluaran_barang()
  {
    return $this->hasOne(pengeluaran_barang::class, 'detail_pengeluaran_barang', 'detail_pengeluaran_barang');
  }
}
