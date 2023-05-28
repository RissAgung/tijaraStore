<?php

namespace App\Models\retur;

use App\Models\products\barang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
  use HasFactory;
  protected $table = 'retur_customer'; // mendevinisikan nama table
  protected $primaryKey = 'kode_retur_cs'; // mendevinisikan primary key
  public $incrementing = false; // auto pada primaryKey incremment false
  public $timestamps = false;

  protected $fillable = array('kode_retur_cs', 'tanggal', 'nama_pegawai', 'kode_br', 'kode_tr', 'QTY', 'jenis_pengembalian', 'bayar_kurang', 'kembalian_tunai', 'bayar_tunai', 'kode_br_keluar');

  public function barangReturCS()
  {
    return $this->belongsTo(barang::class, 'kode_br', 'kode_br');
  }

  public function barangKeluarReturCS()
  {
    return $this->belongsTo(barang::class, 'kode_br_keluar', 'kode_br');
  }
}
