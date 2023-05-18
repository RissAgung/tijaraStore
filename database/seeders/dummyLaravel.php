<?php

namespace Database\Seeders;

use App\Models\riwayat\detail_transaksi;
use App\Models\riwayat\transaksi;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class dummyLaravel extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {

    // pemasukan::truncate();
    // detail_tr::truncate();

    for ($i = 0; $i < 50; $i++) {
      # code...
      $id = uniqid();
      transaksi::create([
        'kode_tr' => $id,
        'total' => 50000,
        'bayar' => 50000,
        'nama_kasir' => 'rizal',
        'kembalian' => 0,
        'tanggal' => Carbon::now(),
        'jenis_pembayaran' => 'Cash'
      ]);

      detail_transaksi::create([
        'kode_tr' => $id,
        'QTY' => 5,
        'subtotal' => 400000,
        'kode_br' => 1680855250
      ]);
    }

    for ($i = 0; $i < 50; $i++) {
      # code...
      $id = uniqid();
      transaksi::create([
        'kode_tr' => $id,
        'total' => 50000,
        'bayar' => 50000,
        'nama_kasir' => 'rizal',
        'kembalian' => 0,
        'tanggal' => Carbon::now(),
        'jenis_pembayaran' => 'Cash'
      ]);

      detail_transaksi::create([
        'kode_tr' => $id,
        'QTY' => 5,
        'subtotal' => 400000,
        'kode_br' => 1680856746
      ]);
    }

    for ($i = 0; $i < 50; $i++) {
      # code...
      $id = uniqid();
      transaksi::create([
        'kode_tr' => $id,
        'total' => 50000,
        'bayar' => 50000,
        'nama_kasir' => 'rizal',
        'kembalian' => 0,
        'tanggal' => Carbon::now(),
        'jenis_pembayaran' => 'Cash'
      ]);

      detail_transaksi::create([
        'kode_tr' => $id,
        'QTY' => 5,
        'subtotal' => 400000,
        'kode_br' => 1680856989
      ]);
    }


    // Membuat data pengguna dummy menggunakan factory
    // pemasukan::create();
  }
}
