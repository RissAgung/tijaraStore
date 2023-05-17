<?php

namespace App\Models\riwayat;

use App\Models\products\barang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_transaksi extends Model
{
    use HasFactory;
    protected $table = 'detail_transaksi';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = array('kode_tr', 'QTY', 'subtotal', 'kode_br', 'kode_diskon');

    public function transaksi(){
        return $this->belongsTo(transaksi::class, 'kode_tr', 'kode_tr');
    }

    public function detail_diskon_transaksi(){
        return $this->hasOne(detail_diskon_transaksi::class, 'kode_diskon', 'kode_diskon');
    }

    public function barang(){
        return $this->belongsTo(barang::class, 'kode_br', 'kode_br');
    }
}
