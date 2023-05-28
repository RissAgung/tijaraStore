<?php

use App\Http\Controllers\Akumulasi;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterDataProduct;
use App\Http\Controllers\pengeluaran_operasioanal;
use App\Http\Controllers\report\pemasukan;
use App\Http\Controllers\report\pengeluaran;
use App\Http\Controllers\retur_customer;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\RiwayatRetur;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\pengeluaran_re_stock;
use App\Http\Controllers\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
  return view("front_view.landing");
})->name('landing')->middleware('guest');

Route::prefix("produk")->group(function () {
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

Route::get('/dashboard', [DashboardController::class, 'index']);

//apabila belum login atau statusnya belum auth secara otomatis akan terlempar ke home, path home sendiri diatur pada App/Providers/RouteServiceProvider.php baris 20
Route::get("/login", [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post("/login", [LoginController::class, 'checkLogin']);
Route::post("/logout", [LoginController::class, 'logout']);

// Route::get("/register", function () {
//   return view('front_view.register');
// });
// Route::post("/register", [LoginController::class, 'registerhahai'])->middleware('guest');
Route::redirect('/laporan', '/laporan/pemasukan');
Route::prefix("laporan")->middleware('auth')->group(function () {
  Route::get("/pemasukan/{date?}", [pemasukan::class, 'index'])->name("pemasukan");

  Route::get("/pengeluaran/{date?}", [pengeluaran::class, 'index'])->name("pengeluaran");

  Route::get("/akumulasi", function () {
    return view("report.akumulasi");
  })->name("akumulasi");

  // for ajax
  Route::get("/getAkumulasi", [Akumulasi::class, "getPemasukanPengeluaran"])->name("getAkumulasi");
  Route::get("/getPieChart", [Akumulasi::class, "getDataPie"])->name("getPieChart");
  Route::get('/getDetailPemasukan', [pemasukan::class, 'getDetail']);
  Route::get('/getDetailPengeluaran', [pengeluaran::class, 'getDetail']);

  // export
  Route::get('/pemasukan.export/{date?}', [pemasukan::class, "export"]);
  Route::get('/pengeluaran.export/{date?}', [pengeluaran::class, "export"]);
  Route::get('/akumulasi.export/{date?}', [Akumulasi::class, "export"]);
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

Route::get('/retur_cs/{date?}', [retur_customer::class, 'index']);

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
Route::get('/voucher/search/{search?}', [VoucherController::class, 'filter_search'])->where('search', '.*');
Route::get('/voucher/filter/{kategori?}', [VoucherController::class, 'filter_kategori']);

Route::prefix('pengeluaran')->group(function () {
  Route::get("/", [pengeluaran_operasioanal::class, 'index'])->name('operasional')->middleware('auth');
  Route::get("/operasional/{date?}", [pengeluaran_operasioanal::class, 'index'])->name('operasional')->middleware('auth');
  Route::post('operasional.store', [pengeluaran_operasioanal::class, 'store'])->middleware('auth');
  Route::get('/re-stock',[pengeluaran_re_stock::class,'index'])->name('halaman_restock')->middleware('auth');
  Route::post('re-stock.store',[pengeluaran_re_stock::class,'store'])->name('proses')->middleware('auth');
  Route::get('/re-stock/search',[pengeluaran_re_stock::class,'index'])->name('cari_restock');
  Route::get('/re-stock/export', [pengeluaran_re_stock::class, 'export'])->name('kirim');
  Route::get('/re-stock/{date?}',[pengeluaran_re_stock::class,'index'])->name('tanggal');
});

Route::prefix("supplier")->group(function () {
  Route::resource("/", \App\Http\Controllers\SupplierController::class);
  Route::post('/add', [SupplierController::class, 'store']);
  Route::post('/edit', [SupplierController::class, 'update']);
  Route::get('/delete/{kode}', [SupplierController::class, 'delete']);
  Route::post('/delete_selected', [SupplierController::class, 'delete_selected']);
  Route::get('/search', [SupplierController::class, 'search'])->name('search');
});


Route::prefix("/salary")->group(function () {
  //Route::resource("/{date?}", \App\Http\Controllers\GajiController::class);
  Route::get('/{search?}', [GajiController::class, 'index']);
  Route::post('/add', [GajiController::class, 'add_gaji']);
  Route::post('/edit', [GajiController::class, 'edit_gaji']);
});

Route::prefix('/pegawai')->group(function () {
  Route::get('/', [PegawaiController::class, 'index'])->name('halaman_utama');
  Route::post('/tambah', [PegawaiController::class, 'store'])->name('tambah_pegawai');
  Route::get('/delete/{kodeP}/', [PegawaiController::class, 'delete'])->name('hapus_pegawai');
  Route::post('/edit', [PegawaiController::class, 'edit'])->name('edit_pegawai');
  Route::post('/delete_selected', [PegawaiController::class, 'delete_selected'])->name('delete_selected');
  Route::get('/search', [PegawaiController::class, 'search'])->name('cari');
  Route::get('/filterG/{gender}', [PegawaiController::class, 'filter'])->name('filterG');
  Route::get('/filterR/{role}', [PegawaiController::class, 'filterR'])->name('filterR');
});

Route::prefix('pengeluaran')->group(function () {
  Route::get("/", [pengeluaran_operasioanal::class, 'index'])->name('operasional')->middleware('auth');
  Route::get("/operasional/{date?}", [pengeluaran_operasioanal::class, 'index'])->name('operasional')->middleware('auth');
  Route::post('operasional.store', [pengeluaran_operasioanal::class, 'store'])->middleware('auth');
  Route::get('/re-stock', [pengeluaran_re_stock::class, 'index'])->name('halaman_restock')->middleware('auth');
  Route::post('re-stock.store', [pengeluaran_re_stock::class, 'store'])->name('proses')->middleware('auth');
  Route::get('/re-stock/search', [pengeluaran_re_stock::class, 'index'])->name('cari_restock');
  Route::get('/re-stock/export', [pengeluaran_re_stock::class, 'export'])->name('kirim');
  Route::get('/re-stock/{date?}', [pengeluaran_re_stock::class, 'index'])->name('tanggal');
});
