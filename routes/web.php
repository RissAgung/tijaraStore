<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterDataProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
  return view("layout.main");
});

Route::get("/product", [MasterDataProduct::class, 'products'])->name('product');

Route::post('/product/add', [MasterDataProduct::class, 'add_products']);

Route::get('/product/delete/{kode}', [MasterDataProduct::class, 'delete']);

Route::post('/product/delete_selected', [MasterDataProduct::class, 'delete_selected']);

Route::get('/filtertags/{kode}', function ($kode) {
  return $kode;
});

//apabila belum login atau statusnya belum auth secara otomatis akan terlempar ke home, path home sendiri diatur pada App/Providers/RouteServiceProvider.php baris 20
Route::get("/login", [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post("/login", [LoginController::class, 'checkLogin']);
Route::post("/logout", [LoginController::class, 'logout']);

// Route::get("/register", function () {
//   return view('front_view.register');
// });
// Route::post("/register", [LoginController::class, 'registerhahai'])->middleware('guest');

Route::prefix("laporan")->group(function () {
  Route::get("/pemasukan", function () {
    return view("report.pemasukan");
  })->middleware('auth');
});

Route::get("/retur", function () {
  return view("retur.retur");
})->middleware('auth');
