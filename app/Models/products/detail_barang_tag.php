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

    protected $fillable = array('detail_kode_barang_tag', 'kode_tag');

    public function barang(){
        return $this->hasOne(barang::class);
    }

    public function tag(){
        return $this->belongsTo(tag::class, 'kode_tag', 'kode_tag');
    }
}
