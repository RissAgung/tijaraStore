<?php

namespace App\Http\Controllers;

use App\Models\riwayat\transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(){
        $data = transaksi::with('detail_transaksi.detail_diskon_transaksi')
            ->with('detail_transaksi.barang')
            ->orderBy('tanggal', 'desc')
            ->paginate(6);

        return view('riwayat.riwayat', compact('data'));
    }
}