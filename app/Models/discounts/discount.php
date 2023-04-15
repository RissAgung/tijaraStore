<?php

namespace App\Models\discounts;

use App\Models\products\barang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class discount extends Model
{
    use HasFactory;
    protected $table = 'diskon';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = array('kode_diskon', 'kategori', 'nominal', 'free_product', 'created_at', 'updated_at');

    public function barang(){
        return $this->belongsTo(barang::class, 'kode_diskon', 'kode_diskon');
    }

}
