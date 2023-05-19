<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\supplier;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class SupplierController extends Controller
{
    public function index()
    {
        $sup = supplier::orderBy('created_at', 'desc')
        ->paginate(5);
        return view('supplier.data_supplier', compact('sup'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'ket' => 'required',
            'kontak' => 'required|numeric',
            'alamat' => 'required'
        ], [
            'required' => 'Field Wajib Diisi!'
        ]);       

        $kode = time();

        supplier::create([
            'kode_supplier' => $kode,
            'nama_supplier' => $request->nama,
            'keterangan_sup' => $request->ket,
            'no_hp_supplier' => $request->kontak,
            'alamat' => $request->alamat,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        alert()->success('Berhasil', 'Berhasil Menambahkan Data');    
        return redirect('/supplier');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_update' => 'required',
            'nama_update' => 'required',
            'ket_update' => 'required',
            'kontak_update' => 'required|numeric',
            'alamat_update' => 'required'
        ], [
            'required' => 'Field wajib diisi!'
        ]);

        $sup = supplier::find($request->id_update);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['update' => 'error update']);
        }

        $sup->nama_supplier = $request->nama_update;
        $sup->keterangan_sup = $request->ket_update;
        $sup->no_hp_supplier = $request->kontak_update;
        $sup->alamat = $request->alamat_update;
        $sup->updated_at = Carbon::now();

        $sup->save();

        alert()->success('Berhasil', 'Berhasil Mengubah Data');    
        return redirect('/supplier');
    }

    public function delete($kode, Request $request)
    {

    if ($request->has('token')) {
        if ($request->token === $request->session()->token()) {
            $request->session()->regenerateToken();
            $sup = supplier::find($kode);
            supplier::find($kode)->delete();  
            alert()->success('Berhasil', 'Berhasil Menghapus Data');    
            return redirect('/supplier');
        } else {
            return redirect('/supplier');
        }
    } 
    else {
        return redirect('/supplier');
    }

    }

    
    public function delete_selected(Request $request)
    {
        foreach ($request->ids as $value) {
            $products = supplier::find($value);
            supplier::find($value)->delete();
        }
        alert()->success('Berhasil', 'Berhasil Menghapus Data');
        return redirect('/supplier');
    }


    public function search(Request $request)
    {
        $sup = supplier::where('nama_supplier', 'LIKE', '%' . $request->find . '%')
            ->orWhere('keterangan_sup', 'LIKE', '%' . $request->find . '%')
            ->paginate(5);


        if ($request->has('find')) {
            $sup->appends(array(
                'find' => $request->find
            ));
        }

        return view('supplier.data_supplier', compact('sup'));
    }
}
