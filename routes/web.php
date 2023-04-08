<?php

use App\Http\Controllers\MasterDataProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
  return view("layout.main");
});

Route::prefix("product")->group(function () {
  Route::get("/", [MasterDataProduct::class, 'products'])->name('product');

  Route::post('/add', [MasterDataProduct::class, 'add_products']);

  Route::get('/delete/{kode}', [MasterDataProduct::class, 'delete']);

  Route::post('/delete_selected', [MasterDataProduct::class, 'delete_selected']);

  Route::get('/tags', [MasterDataProduct::class, 'filter_tags']);

  Route::get('/search', [MasterDataProduct::class, 'filter_search'])->name('search_product');

  Route::get('/kategori', [MasterDataProduct::class, 'filter_kategori']);

  Route::post('/update', [MasterDataProduct::class, 'update_product']);

});


Route::get("/login", function () {
  return view('front_view.login');
});

Route::prefix("laporan")->group(function () {
  Route::get("/pemasukan", function () {
    return view("report.pemasukan");
  });
});

Route::get("/retur", function () {
  return view("retur.retur");
});

Route::get("/landing", function () {
  return view("layout.landing_main");
});

Route::get('/riwayat', function () {
  return view('riwayat.riwayat');
});
