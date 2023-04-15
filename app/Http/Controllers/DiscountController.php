<?php

namespace App\Http\Controllers;

use App\Models\discounts\discount;
use App\Models\products\barang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    public function index(){
        $barang = barang::with('diskon')->whereHas('diskon', function($query){
            $query->whereNotNull("kode_diskon");
        })->paginate(5);

        return view("discount.discount", compact("barang"));
    }

    public function tambah_diskon(Request $request)
    {

        $kode = '';
        if ($request->jenis_discount == "persen") {
            $kode = "PE" . time();
            $barang = barang::find($request->txt_kode);
            $barang->kode_diskon = $kode;
            $barang->save();

            discount::create([
                'kode_diskon' => $kode,
                'kategori' => $request->jenis_discount,
                'nominal' => $request->txt_nominal,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);
        } else if ($request->jenis_discount == "nominal") {
            $kode = "NM" . time();
            $barang = barang::find($request->txt_kode);
            $barang->kode_diskon = $kode;
            $barang->save();

            discount::create([
                'kode_diskon' => $kode,
                'kategori' => $request->jenis_discount,
                'nominal' => str_replace(".", "", $request->txt_nominal),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);
        } else {
            $kode = "FR" . time();
            $barang = barang::find($request->txt_kode);
            $barang->kode_diskon = $kode;
            $barang->save();

            $arr = array(
                "free" => $request->jenis_free,
                "value" => array(
                    "buy" => $request->txt_beli,
                    "gratis" => $request->txt_gratis,
                ),
            );

            discount::create([
                'kode_diskon' => $kode,
                'kategori' => $request->jenis_discount,
                'free_product' => json_encode($arr),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }



        alert()->success('Berhasil', 'Berhasil Menambahkan Data');
        return redirect('/discount');
    }
}
