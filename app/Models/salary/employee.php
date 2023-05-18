<?php

namespace App\Models\salary;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    public function account()
    {
        return $this->hasOne(acc::class, 'kode_pegawai', 'kode_pegawai');
    }
}
