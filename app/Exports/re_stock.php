<?php

namespace App\Exports;

use App\Models\pengeluaran\pengeluaran;
use App\Models\pengeluaran\pengeluaran_barang;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;



class re_stock implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
          return DB::table('pengeluaran')
    ->join('pengeluaran_pegawai', 'pengeluaran_pegawai.pegawai_pengeluaran', '=', 'pengeluaran.detail_pengeluaran_pegawai')
    ->join('pegawai', 'pegawai.kode_pegawai', '=', 'pengeluaran_pegawai.kode_pegawai')
    ->join('pengeluaran_barang', 'pengeluaran_barang.detail_pengeluaran_barang', '=', 'pengeluaran.detail_pengeluaran_barang')
    ->join('barang', 'barang.kode_br', '=', 'pengeluaran_barang.kode_br')
    ->select('pengeluaran.detail_pengeluaran_barang', 'pengeluaran.tanggal', 'pegawai.nama', 'barang.nama_br', 'pengeluaran.jumlah', 'pengeluaran.total')
    ->get();
    //     $combinedata = $result;
    //  return view('pengeluaran.data_pengeluaran_mainR',compact('combinedata'));
    }

}
