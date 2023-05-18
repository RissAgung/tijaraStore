<?php

use App\Http\Controllers\Akumulasi;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterDataProduct;
use App\Http\Controllers\pengeluaran_operasioanal;
use App\Http\Controllers\report\pemasukan;
use App\Http\Controllers\report\pengeluaran;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\RiwayatRetur;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\SupplierController;
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

  Route::get('/tag/delete/{kode}', [MasterDataProduct::class, 'delete_tag']);

  Route::post('/tag/add', [MasterDataProduct::class, 'tambah_tag']);
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
  Route::get("/", [pemasukan::class, 'index'])->name("pemasukan")->middleware('auth');

  Route::get("/pemasukan", [pemasukan::class, 'index'])->name("pemasukan")->middleware('auth');

  Route::get("/pengeluaran/{date?}", [pengeluaran::class, 'index'])->name("pengeluaran")->middleware('auth');

  Route::get("/akumulasi", function () {
    return view("report.akumulasi");
  })->name("akumulasi")->middleware('auth');
  Route::get("/getAkumulasi", [Akumulasi::class, "getPemasukan"])->name("getAkumulasi")->middleware('auth');
});

Route::prefix('pengeluaran')->group(function () {
  Route::get("/", [pengeluaran_operasioanal::class, 'index'])->name('operasional')->middleware('auth');
  Route::get("/operasional/{date?}", [pengeluaran_operasioanal::class, 'index'])->name('operasional')->middleware('auth');
  Route::post('operasional.store', [pengeluaran_operasioanal::class, 'store'])->middleware('auth');
});

Route::prefix("retur")->group(function () {
  Route::get("/{search?}", [ReturController::class, 'index'])->name('retur')->middleware('auth');
  Route::post("/add", [ReturController::class, 'submit_retur'])->middleware('auth');
});

Route::prefix("riwayatRetur")->group(function () {
  Route::get("/{date?}", [RiwayatRetur::class, "index"])->name('riwayatRetur')->middleware('auth');
});

Route::get("/landing", function () {
  return view("layout.landing_main");
});

Route::get('/riwayat', [TransaksiController::class, 'index']);
Route::get('/riwayat/filter/{data?}', [TransaksiController::class, 'filter']);
Route::get('/riwayat/search/{data?}', [TransaksiController::class, 'search']);
Route::get('/riwayat/export/{kategori?}/{data?}', [TransaksiController::class, 'export']);
Route::get('/riwayat/cetak/{data?}', [TransaksiController::class, 'cetak']);

Route::get('/diskon', [DiscountController::class, 'index'])->name('diskon');

Route::post('/diskon/add', [DiscountController::class, "tambah_diskon"]);

Route::post('/diskon/update', [DiscountController::class, "update_diskon"]);

Route::post('/diskon/delete_selected', [DiscountController::class, "delete_selected"]);

Route::get('/diskon/delete/{kode}', [DiscountController::class, 'delete']);

Route::get('/diskon/kategori', [DiscountController::class, 'filter_kategori']);

Route::get('/diskon/search', [DiscountController::class, 'filter_search']);


Route::view('/riwayat/struk', 'riwayat.struk');

Route::get('/voucher', [VoucherController::class, 'index'])->name('voucher');
Route::post('/voucher/add', [VoucherController::class, 'addData']);
Route::post('/voucher/update', [VoucherController::class, 'updateData']);
Route::post('/voucher/delete_selected', [VoucherController::class, 'deleteSelected']);
Route::get('/voucher/delete/{id}', [VoucherController::class, 'deleteData']);
Route::get('/voucher/search/{search?}', [VoucherController::class, 'filter_search']);
Route::get('/voucher/filter/{kategori?}', [VoucherController::class, 'filter_kategori']);

Route::prefix('pengeluaran')->group(function () {
  Route::get("/", [pengeluaran_operasioanal::class, 'index'])->name('operasional')->middleware('auth');
  Route::get("/operasional/{date?}", [pengeluaran_operasioanal::class, 'index'])->name('operasional')->middleware('auth');
  Route::post('operasional.store', [pengeluaran_operasioanal::class, 'store'])->middleware('auth');
});


Route::prefix("supplier")->group(function() {
  Route::resource("/", \App\Http\Controllers\SupplierController::class);
  Route::post('/add',[SupplierController::class, 'store']);
  Route::post('/edit', [SupplierController::class, 'update']);
  Route::get('/delete/{kode}', [SupplierController::class, 'delete']);
  Route::post('/delete_selected', [SupplierController::class, 'delete_selected']);
  Route::get('/search', [SupplierController::class, 'search'])->name('search');
});


Route::prefix("/salary")->group(function() {
  //Route::resource("/{date?}", \App\Http\Controllers\GajiController::class);
  Route::get('/{search?}', [GajiController::class, 'index']);
  Route::post('/add', [GajiController::class, 'add_gaji']);
  Route::post('/edit', [GajiController::class, 'edit_gaji']);
});