<?php

namespace App\Http\Controllers;

use App\Models\products\barang;
use App\Models\products\detail_barang_tag;
use App\Models\products\tag;
use Illuminate\Http\Request;

class MasterDataProduct extends Controller
{
    public function products()
    {

        // echo barang::all()->sortByDesc('kode_barang_tag')->first()->kode_barang_tag;
        // $products = barang::with('barang_tag')
        //     ->get();

        $products = barang::with('detail_barang_tag.tag')->paginate(1);
        // return $products;
        // $tags = barang::join('barang_tag', 'barang_tag.kode_barang_tag', '=', 'barang.kode_barang_tag')
        //     ->join('detail_barang_tag', 'detail_barang_tag.detail_kode_barang_tag', '=', 'barang_tag.detail_kode_barang_tag')
        //     ->join('tag', 'tag.kode_tag', '=', 'detail_barang_tag.kode_tag')
        //     ->get('*');

        // return $tags;
        $tags = tag::all();

        return view('master.data_product', compact('products', 'tags'));
    }

    public function add_products(Request $request){
        $this->validate($request, [
            'txt_nama' => 'required|max:30',
            'txt_warna' => 'required',
            'txt_kategori' => 'required',
            'txt_ukuran' => 'required',
            'txt_harga' => 'required',
            'tags' => 'required',
            'txt_foto' => 'required|image|mimes:jpg,png,jpeg',
            'jenis' => 'required'

        ], [
            'required' => 'Field :attribute wajib diisi!'
        ]);

        $kode = (barang::all()->sortByDesc('kode_barang_tag')->first()->kode_br + 1);

        barang::create([
            'kode_br' => $kode,
            'kategori' => $request->txt_kategori,
            'kode_barang_tag' => $kode,
            'nama_br' => $request->txt_nama,
            'stok' => 0,
            'gambar' => $request->txt_foto->getClientOriginalExtension(),
            'harga' => $request->txt_harga,
            'ukuran' => $request->txt_ukuran,
            'warna' => $request->txt_warna,
            'jenis' => $request->jenis
        ]);

        foreach ($request->tags as  $value) {
            detail_barang_tag::create([
                'detail_kode_barang_tag' => $kode,
                'kode_tag' => $value
            ]);
        }
        

        return redirect()->route('product');
    }
}
