<?php

namespace App\Http\Controllers;

use App\Models\products\barang;
use App\Models\retur\supplier;
use App\Models\supplier as ModelsSupplier;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class ReturController extends Controller
{
  // Contoh di bawah, parameter "search" memiliki nilai default "null". Jika parameter "search" tidak diberikan pada URL, maka nilai default "null" akan digunakan.
  //Namun, nilai default hanya dapat diberikan pada parameter terakhir dari metode controller. Jadi, jika ada beberapa parameter untuk metode controller, pastikan untuk menempatkan parameter dengan nilai default pada posisi terakhir.
  public function index(Request $request, $search = null)
  {


    $products = function ($request, $search) use (&$ssearch, &$skategori) {
      if ($this->isAllFilter($this->isSearch($search), $this->isKategori($request->filter))) {
        $ssearch = $search;
        $skategori = $request->filter;
        return barang::where('nama_br', 'LIKE', '%' . $search . '%')
          ->where('kategori', '=', $request->filter)
          ->where('stok', '>', 0)
          ->orWhere('kode_br', 'LIKE', '%' . $request->search . '%')
          ->where('kategori', '=', $request->filter)
          ->where('stok', '>', 0)
          ->paginate(10);
      }

      if ($this->isSearch($search)) {
        $ssearch = $search;
        return barang::where('nama_br', 'LIKE', '%' . $search . '%')
          ->where('stok', '>', 0)
          ->orWhere('kode_br', 'LIKE', '%' . $search . '%')
          ->where('stok', '>', 0)
          ->paginate(10);
      }

      if ($this->isKategori($request->filter)) {
        $skategori = $request->filter;
        return barang::where('kategori', '=', $request->filter)
          ->where('stok', '>', 0)
          ->paginate(10);
        // dd($request->filter);
      }

      $ssearch = '';
      $skategori = '';

      return barang::where('stok', '>', 0)->paginate(10);
    };

    $finalProduct = $products($request, $search);
    $supplier = ModelsSupplier::all();

    if ($request->has('filter')) {
      $finalProduct->appends(array(
        'filter' => $request->filter
      ));
    }

    $dataUrl = array(
      "search" => $ssearch,
      "kategori" => $skategori
    );

    return view('retur.retur', compact('finalProduct', 'dataUrl', 'supplier'));
  }

  private function isSearch($search)
  {
    return $search !== null ? true : false;
  }
  private function isKategori($kategori)
  {
    return $kategori !== null ? true : false;
  }
  private function isAllFilter($search, $kategori)
  {
    return $search === true && $kategori === true ? true : false;
  }

  public function submit_retur(Request $request)
  {

    $request->validate([
      'nama_produk' => 'required',
      'jumlah_barang' => 'required',
      'supplier' => 'required',
      'jumlah_retur' => 'required',
      'uang_kembali' => 'required',
    ], [
      'required' => 'Field :attribute wajib diisi!'
    ]);

    $now = DB::raw('CURRENT_TIMESTAMP');
    $id = str_shuffle(date('YmdHis') . 'RTR');
    $data_sp = ModelsSupplier::where('kode_supplier', $request->supplier)->first();
    $jumlah_nominal = preg_replace('/[^0-9]/', '', $request->uang_kembali);
    
    $supplier = new supplier([
      'kode_retur' => $id,
      'tanggal' => $now,
      'nama_br' => $request->nama_produk,
      'QTY' => $request->jumlah_barang,
      'nama_sp' => $data_sp->nama_supplier,
      'no_hp_sp' => $data_sp->no_hp_supplier,
      'instansi' => $data_sp->keterangan_sup,
      'jml_barang' => $request->jumlah_retur,
      'jml_nominal' => $jumlah_nominal
    ]);

    try {
      $supplier->save();
      alert()->success('Berhasil', 'Data retur berhasil disimpan')->autoClose(3000);
      return redirect()->route('retur');
    } catch (\Throwable $e) {
      // dd($e);
      alert()->error('Gagal', 'Data retur gagal disimpan ' . $e);
      return redirect()->route('retur');
    }
  }
}
