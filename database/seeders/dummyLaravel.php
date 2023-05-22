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

    for ($i = 0; $i < 1; $i++) {
      # code...
      $id = uniqid();
      transaksi::create([
        'kode_tr' => $id,
        'total' => 200000,
        'bayar' => 200000,
        'nama_kasir' => 'rizal',
        'kembalian' => 0,
        'tanggal' => '2023-05-19 01:58:28',
        'jenis_pembayaran' => 'Cash'
      ]);

      detail_transaksi::create([
        'kode_tr' => $id,
        'QTY' => 5,
        'subtotal' => 40000,
        'kode_br' => 1684643612
      ]);
    }

    for ($i = 0; $i < 1; $i++) {
      # code...
      $id = uniqid();
      transaksi::create([
        'kode_tr' => $id,
        'total' => 300000,
        'bayar' => 300000,
        'nama_kasir' => 'rizal',
        'kembalian' => 0,
        'tanggal' => '2023-05-19 01:58:28',
        'jenis_pembayaran' => 'Cash'
      ]);

      detail_transaksi::create([
        'kode_tr' => $id,
        'QTY' => 5,
        'subtotal' => 60000,
        'kode_br' => 1684643520
      ]);
    }

    for ($i = 0; $i < 1; $i++) {
      # code...
      $id = uniqid();
      transaksi::create([
        'kode_tr' => $id,
        'total' => 600000,
        'bayar' => 600000,
        'nama_kasir' => 'rizal',
        'kembalian' => 0,
        'tanggal' => '2023-05-19 01:58:28',
        'jenis_pembayaran' => 'Cash'
      ]);
      // 2023-05-18 01:58:28
      detail_transaksi::create([
        'kode_tr' => $id,
        'QTY' => 6,
        'subtotal' => 100000,
        'kode_br' => 1684641177
      ]);
    }

    for ($i = 0; $i < 1; $i++) {
      # code...
      $id = uniqid();
      transaksi::create([
        'kode_tr' => $id,
        'total' => 1200000,
        'bayar' => 1200000,
        'nama_kasir' => 'rizal',
        'kembalian' => 0,
        'tanggal' => '2023-05-19 01:58:28',
        'jenis_pembayaran' => 'Cash'
      ]);
      // 2023-05-18 01:58:28
      detail_transaksi::create([
        'kode_tr' => $id,
        'QTY' => 6,
        'subtotal' => 200000,
        'kode_br' => 1684642926
      ]);
    }

    // 1680856928


    // Membuat data pengguna dummy menggunakan factory
    // pemasukan::create();
  }
}
