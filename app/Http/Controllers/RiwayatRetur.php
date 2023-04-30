<?php

namespace App\Http\Controllers;

use App\Models\retur\supplier;
use Illuminate\Http\Request;

class RiwayatRetur extends Controller
{
  public function index($search = null)
  {

    $dataReturDB = function ($search) {
      if ($search !== null) {
        return supplier::where('kode_retur', 'LIKE', '%' . $search . '%')
          ->orWhere('nama_br', 'LIKE', '%' . $search . '%')
          ->orderBy('created_at', 'desc')
          ->paginate(10);
      }

      return supplier::orderBy('created_at', 'desc')
        ->paginate(10);
    };

    $dataRetur = $dataReturDB($search);
    return view("retur.riwayat", compact("dataRetur", "search"));
    // dd($dataRetur);
  }
}
