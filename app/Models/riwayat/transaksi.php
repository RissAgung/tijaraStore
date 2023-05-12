<?php

namespace App\Models\riwayat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primaryKey = 'kode_tr';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = array('kode_tr', 'total', 'bayar', 'voucher', 'nama_kasir', 'kembalian', 'tanggal', 'jenis_pembayaran');

    public function detail_transaksi(){
        return $this->hasMany(detail_transaksi::class, 'kode_tr', 'kode_tr');
    }


}
