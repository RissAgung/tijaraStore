<?php

namespace App\Models\products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primaryKey = 'kode_br';
    public $incrementing = false;
    public $timestamps = false;

    public function barang_tag(){
        return $this->belongsTo(barang_tag::class, 'kode_barang_tag', 'kode_barang_tag');
    }

}
