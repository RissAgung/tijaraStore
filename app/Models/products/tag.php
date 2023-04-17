<?php

namespace App\Models\products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;
    protected $table = 'tag';
    public $incrementing = false;
    protected $primaryKey = 'kode_tag';
    public $timestamps = false;

    protected $fillable = array('kode_tag', 'nama_tag');

    public function detail_barang_tag(){
        return $this->hasOne(detail_barang_tag::class, 'kode_tag', 'kode_tag');
    }
}
