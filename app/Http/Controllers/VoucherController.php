<?php

namespace App\Http\Controllers;

use App\Models\voucher\voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoucherController extends Controller
{
    public function index()
    {
        $voucher = voucher::orderBy('created_at', 'desc')->paginate(6);
        return view('voucher.voucher', compact('voucher'));
    }

    public function addData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'txt_kode_voucher' => 'required|max:20|unique:voucher,kode_voucher',
            'txt_nama' => 'required',
            'jenis_voucher' => 'required',
            'txt_nominal' => 'required'
        ], [
            'required' => 'Field wajib diisi!',
            'unique' => 'Kode voucher sudah ada!'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['tambah' => 'error tambah']);
        }


        $voucher = new voucher;
        $voucher->kode_voucher = $request->txt_kode_voucher;
        $voucher->nama_voucher = $request->txt_nama;
        $voucher->kategori = $request->jenis_voucher;
        $voucher->nominal = str_replace('.', '', $request->txt_nominal);
        $voucher->save();

        alert()->success('Berhasil', 'Berhasil Menambahkan Data');
        return redirect('/voucher');
    }

    public function updateData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'txt_kode_voucher_update' => 'required|max:20',
            'txt_nama_update' => 'required',
            'jenis_voucher_update' => 'required',
            'txt_nominal_update' => 'required'
        ], [
            'required' => 'Field wajib diisi!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['update' => 'error update']);
        }

        $voucher = voucher::find($request->txt_kode_voucher_update);
        $voucher->nama_voucher = $request->txt_nama_update;
        $voucher->kategori = $request->jenis_voucher_update;
        $voucher->nominal = str_replace('.', '', $request->txt_nominal_update);
        $voucher->save();

        alert()->success('Berhasil', 'Berhasil Mengubah Data');
        return redirect('/voucher');
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->ids as $value) {
            voucher::find($value)->delete();
        }
        alert()->success('Berhasil', 'Berhasil Menghapus Data');
        return redirect('/voucher');
    }

    public function deleteData($kode, Request $request)
    {
        // check apakah terdapat token
        if ($request->has('token')) {
            // check apakah token sesuai dengan token yang ada pada session ?
            if ($request->token === $request->session()->token()) {
                // jika sesuai maka akan proses dan generate ulang token
                // jadi, tidak akan terjadi penggunaan token yang sama
                // hal ini dilakukan untuk pencegahan untuk hal hal yang tidak diinginkan
                // seperti memaksa menggunakan token yang telah dipakai sebelumnya untuk menghapus data yang lain
                $request->session()->regenerateToken();
                voucher::find($kode)->delete();

                alert()->success('Berhasil', 'Berhasil Menghapus Data');
                return redirect('/voucher');
            } else {
                alert()->warning('Informasi', 'Token tidak sesuai');
                return redirect('/voucher');
            }
        } else {
            alert()->warning('Informasi', 'Token tidak ditemukan');
            return redirect('/voucher');
        }
    }

    public function filter_search(Request $request){
        if($request->segment(3) == ''){
            return redirect('/voucher');
        }

        $voucher = voucher::where('kode_voucher', '=', $request->segment(3))
            ->orderBy('created_at', 'desc')->paginate(6);
        return view('voucher.voucher', compact('voucher'));
    }

    public function filter_kategori(Request $request){
        if($request->segment(3) == ''){
            return redirect('/voucher');
        }

        $voucher = voucher::where('kategori', '=', $request->segment(3))
            ->orderBy('created_at', 'desc')->paginate(6);
        return view('voucher.voucher', compact('voucher'));
    }
}
