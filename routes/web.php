<?php

use App\Http\Controllers\MasterDataProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
  return view("layout.main");
});

Route::get("/product", [MasterDataProduct::class, 'products']);

Route::post('/product/add', function (Request $request) {
  dd($request);
});;

Route::get('/filtertags/{kode}', function ($kode) {
  return $kode;
});

Route::get("/login", function () {
  return view('front_view.login');
});

Route::prefix("laporan")->group(function(){
  Route::get("/pemasukan", function(){
    return view("report.pemasukan");
  });
});

Route::get("/retur", function(){
  return view("retur.retur");
});
