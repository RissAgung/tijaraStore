<?php

use App\Http\Controllers\MasterDataProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/", function(){
  return view("layout.main");
});

Route::get("/product", [MasterDataProduct::class, 'products'])->name('product');

Route::post('/product/add', [MasterDataProduct::class, 'add_products']);

Route::get('/filtertags/{kode}', function ($kode) {
    return $kode;
});


Route::get("/login", function(){
  return view("front_view.login");
});

Route::get("/landing", function(){
  return view("layout.landing_main");
});
