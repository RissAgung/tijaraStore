<?php

namespace Database\Seeders;

use App\Models\retur\customer;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class retur_cs_dummy extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {

    // retur pengembalian tunai
    customer::create([
      'kode_retur_cs' => $this->setId(),
      'tanggal' => Carbon::now(),
      'nama_pegawai' => 'bintang',
      'kode_br' => '1684643520',
      'kode_tr' => '646b278ae9b1a',
      'QTY' => 2,
      'jenis_pengembalian' => 'tunai',
      'bayar_tunai' => 120000
    ]);

    // retur pengembalian barang pas
    customer::create([
      'kode_retur_cs' => $this->setId(),
      'tanggal' => Carbon::now(),
      'nama_pegawai' => 'bintang',
      'kode_br' => '1684642060',
      'kode_tr' => '646b278aed43d',
      'QTY' => 2,
      'jenis_pengembalian' => 'produk',
      'kode_br_keluar' => '1684641177'
    ]);

    // retur pengembalian barang + kita ngembalikan uang
    customer::create([
      'kode_retur_cs' => $this->setId(),
      'tanggal' => Carbon::now(),
      'nama_pegawai' => 'bintang',
      'kode_br' => '1684643433',
      'kode_tr' => '646b278aecf41',
      'QTY' => 2,
      'jenis_pengembalian' => 'produk',
      'kembalian_tunai' => 40000,
      'kode_br_keluar' => '1684643612',
    ]);

    // retur pengembalian barang + kita dapat uang lebih
    customer::create([
      'kode_retur_cs' => $this->setId(),
      'tanggal' => Carbon::now(),
      'nama_pegawai' => 'bintang',
      'kode_br' => '1684643325',
      'kode_tr' => '646b278aeddf8',
      'QTY' => 2,
      'jenis_pengembalian' => 'produk',
      'bayar_kurang' => 300000,
      'kode_br_keluar' => '1684643612',
    ]);
  }

  function setId()
  {
    return str_shuffle('RTRCS' . date('Yhi'));
  }
}
