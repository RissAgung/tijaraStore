<?php

namespace App\Models\salary;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class acc extends Model
{
    use HasFactory;

    protected $table = 'account';

    public function pegawai()
    {
        return $this->belongsTo(employee::class, 'kode_pegawai', 'kode_pegawai');
    }
    
}
