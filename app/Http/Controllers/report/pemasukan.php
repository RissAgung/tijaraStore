<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\products\barang;
use App\Models\riwayat\detail_transaksi;
use App\Models\riwayat\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pemasukan extends Controller
{
  public function index()
  {

    $data_pemasukan = transaksi::all();
    $produk_terjual = transaksi::with('detail_transaksi.barang')
      ->select('barang.kategori', 'barang.nama_br', DB::raw('COUNT(barang.nama_br) as jumlah'))
      ->join('detail_transaksi', 'transaksi.kode_tr', '=', 'detail_transaksi.kode_tr')
      ->join('barang', 'detail_transaksi.kode_br', '=', 'barang.kode_br')
      // ->where('barang.kategori', 'pria')
      ->groupBy('barang.nama_br', 'barang.kategori')
      ->get();

    $produk_tidak_terjual = barang::leftJoin('detail_transaksi', 'barang.kode_br', '=', 'detail_transaksi.kode_br')
      ->select('barang.kategori', 'barang.nama_br', 'detail_transaksi.kode_tr')
      ->groupBy('barang.kategori', 'barang.nama_br', 'detail_transaksi.kode_tr')
      ->havingRaw('COUNT(detail_transaksi.kode_tr) = 0')
      ->get();

    // dd($produk_tidak_terjual);

    return view('report.pemasukan', compact('data_pemasukan', 'produk_terjual', 'produk_tidak_terjual'));
  }
}
