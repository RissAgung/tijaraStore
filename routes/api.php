<?php

use App\Http\Controllers\Akumulasi;
use App\Http\Controllers\Api\ApiController;
use App\Models\products\barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('product')->group(function () {
    Route::get('/nodiscount', [ApiController::class, 'product_nodiscount']);

    Route::get('/', [ApiController::class, 'product']);

    Route::get('/jual/{search?}', [ApiController::class, 'product_jual'])->where('search', '.*');

    Route::get('/free/{search?}', [ApiController::class, 'product_free'])->where('search', '.*');
});


Route::prefix('voucher')->group(function () {
    Route::get('/', [ApiController::class, 'voucher']);
    Route::get('/kategori/{data?}', [ApiController::class, 'voucher_kategori']);
});

Route::get('/pemasukan_hari_ini', [ApiController::class, 'pemasukan_hari_ini']);

Route::get('/detail_transaksi/{kode_transaksi?}', [ApiController::class, 'detail_transaksi'])->where('kode_transaksi', '.*');

Route::post('/submit_retur_customer', [ApiController::class, 'input_retur_customer']);



Route::get("/akumulasi", [Akumulasi::class, 'getPemasukan']);

Route::post('/login', [ApiController::class, 'checkLoginMobile']);

Route::post('/transaksi', [ApiController::class, 'submitTransaksi']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
