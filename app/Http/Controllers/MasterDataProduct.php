<?php

namespace App\Http\Controllers;

use App\Models\products\barang;
use App\Models\products\tag;
use Illuminate\Http\Request;

class MasterDataProduct extends Controller
{
    public function products()
    {
        // $products = barang::with('barang_tag')
        //     ->get();

        $products = barang::with('barang_tag.detail_barang_tag.tag')->get();
        // return $products;

        // $tags = barang::join('barang_tag', 'barang_tag.kode_barang_tag', '=', 'barang.kode_barang_tag')
        //     ->join('detail_barang_tag', 'detail_barang_tag.detail_kode_barang_tag', '=', 'barang_tag.detail_kode_barang_tag')
        //     ->join('tag', 'tag.kode_tag', '=', 'detail_barang_tag.kode_tag')
        //     ->get('*');

        // return $tags;
        $tags = tag::all();

        return view('master.data_product', compact('products', 'tags'));
    }
}
