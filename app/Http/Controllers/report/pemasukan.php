<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class pemasukan extends Controller
{
  public function index()
  {

    return view('report.pemasukan');
  }
}
