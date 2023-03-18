<?php

namespace App\Models\products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang_tag extends Model
{
    use HasFactory;
    protected $table = 'barang_tag';
    public $timestamps = false;
    public $incrementing = false;

    public function barang(){
        return $this->hasOne(barang::class);
    }

    public function detail_barang_tag(){
        return $this->hasMany(detail_barang_tag::class, 'detail_kode_barang_tag', 'detail_kode_barang_tag');
    }

    

}
