<?php

namespace App\Models;

use App\Models\retur\supplier as ReturSupplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';
    protected $primaryKey = 'kode_supplier';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['kode_supplier', 'nama_supplier', 'keterangan_sup', 'no_hp_supplier', 'alamat','created_at','updated_at'];
}
