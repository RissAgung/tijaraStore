<?php

namespace App\Models\products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_barang_tag extends Model
{
    use HasFactory;
    protected $table = 'DETAIL_BARANG_TAG';
    public $timestamps = false;
    public $incrementing = false;

    public function barang_tag(){
        return $this->belongsTo(barang_tag::class, 'detail_kode_barang_tag', 'detail_kode_barang_tag');
    }

    public function tag(){
        return $this->belongsTo(tag::class, 'kode_tag', 'kode_tag');
    }
}
