<?php

namespace App\Http\Controllers;

use App\Exports\RiwayatExport;
use App\Models\riwayat\transaksi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    public function index(){
        $data = transaksi::with('detail_transaksi.detail_diskon_transaksi')
            ->with('detail_transaksi.barang')
            ->orderBy('tanggal', 'desc')
            ->paginate(6);

        return view('riwayat.riwayat', compact('data'));
    }

    public function filter(Request $request){
        if($request->value == ''){
            return redirect('/riwayat');
        }

        $data = transaksi::with('detail_transaksi.detail_diskon_transaksi')
            ->with('detail_transaksi.barang')
            ->orderBy('tanggal', 'desc')
            ->paginate(6);

        return view('riwayat.riwayat', compact('data'));
    }

    public function search(Request $request){
        if($request->keyword == ''){
            return redirect('/riwayat');
        }

        $data = transaksi::with('detail_transaksi.detail_diskon_transaksi')
            ->with('detail_transaksi.barang')
            ->where('kode_tr', '=', $request->keyword)
            ->orderBy('tanggal', 'desc')
            ->paginate(6);

        return view('riwayat.riwayat', compact('data'));
    }

    public function export(Request $request){
        if($request->kategori != ''){
            return $request->kategori;
        }

        return Excel::download(new RiwayatExport($request->kategori), 'riwayat.xlsx');
    }
}
