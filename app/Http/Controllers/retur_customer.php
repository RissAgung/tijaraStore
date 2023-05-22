<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class retur_customer extends Controller
{
  public function index()
  {
    return view('retur.riwayat_cus');
  }
}
