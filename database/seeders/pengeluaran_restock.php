<?php

namespace Database\Seeders;

use App\Models\pengeluaran\pengeluaran;
use App\Models\pengeluaran\pengeluaran_barang;
use App\Models\pengeluaran\pengeluaran_pegawai;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class pengeluaran_restock extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    for ($i = 0; $i < 1; $i++) {

      $id = 'PENG' . date('Yhi');
      pengeluaran::create([
        'kode_pengeluaran' => $id,
        'tanggal' => Carbon::now(),
        'detail_pengeluaran_pegawai' => 'PEG' . $id,
        'jenis_pengeluaran' => 'restock',
        'detail_pengeluaran_barang' => 'PEB' . $id,
        'jumlah' => 5,
        'total' => 300000
      ]);

      pengeluaran_pegawai::create([
        'pegawai_pengeluaran' => 'PEG' . $id,
        'kode_pegawai' => 'PGK1'
      ]);

      pengeluaran_barang::create([
        'detail_pengeluaran_barang' => 'PEB' . $id,
        'kode_br' => '1684641887'
      ]);
    }
  }
}
