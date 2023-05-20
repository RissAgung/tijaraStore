<?php

namespace App\Models\riwayat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_diskon_transaksi extends Model
{
    use HasFactory;
    protected $table = 'detail_diskon_transaksi';
    protected $primaryKey = 'kode_diskon';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = array('kode_diskon', 'kategori', 'nominal', 'free_product', 'buy', 'free');

    public function detail_transaksi(){
        return $this->belongsTo(detail_transaksi::class, 'kode_diskon', 'kode_diskon');
    }
}
