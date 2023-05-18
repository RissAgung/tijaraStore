<?php

namespace App\Models\salary;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gaji extends Model
{
    use HasFactory;

    protected $table = 'salary';
    protected $primaryKey = 'kode_gaji';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['kode_gaji', 'tanggal', 'nama_pegawai', 'posisi', 'gaji_pokok','bonus','pinjaman','gaji_total','created_at','updated_at'];
}
