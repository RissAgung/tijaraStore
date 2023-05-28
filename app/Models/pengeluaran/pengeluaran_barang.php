<?php

namespace App\Models\pengeluaran;

use App\Models\products\barang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengeluaran_barang extends Model
{
    use HasFactory;
    protected $table = 'pengeluaran_barang';
    public $incrementing = false; // auto pada primaryKey incremment false
    public $timestamps = false; // create_at dan update_at false
    protected $primaryKey = false; // mendevinisikan primary key

    protected $guarded = [];

    public function pengeluaran()
    {
        return $this->belongsTo(pengeluaran::class, 'detail_pengeluaran_barang', 'detail_pengeluaran_barang');
    }

    public function barang()
    {
        return $this->belongsTo(barang::class, 'kode_br', 'kode_br');
    }
}
