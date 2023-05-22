<?php

namespace App\Http\Controllers;

use App\Models\products\barang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {

    $product = barang::where('stok', '<', 5)->get();
    // dd($product);

    return view('dashboard', compact('product'));
  }
}
