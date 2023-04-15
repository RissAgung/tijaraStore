<?php

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

Route::get('/product/nodiscount', function (Request $request) {
    return response()->json([
        barang::whereNull("kode_diskon")
            ->where("kategori", "=", "pria")
            ->where("jenis", "=", "jual")
            ->where("nama_br", "LIKE", "%" . $request->search . "%")
            ->get(),
        barang::whereNull("kode_diskon")
            ->where("kategori", "=", "wanita")
            ->where("jenis", "=", "jual")
            ->where("nama_br", "LIKE", "%" . $request->search . "%")
            ->get(),
        barang::whereNull("kode_diskon")
            ->where("kategori", "=", "anak")
            ->where("jenis", "=", "jual")
            ->where("nama_br", "LIKE", "%" . $request->search . "%")
            ->get(),
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
