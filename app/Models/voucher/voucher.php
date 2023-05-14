<?php

namespace App\Models\voucher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voucher extends Model
{
    use HasFactory;
    protected $table = 'voucher';
    protected $primaryKey = 'kode_voucher';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = array('kode_voucher', 'nama_voucher', 'kategori', 'nominal', 'created_at', 'updated_at');

}
