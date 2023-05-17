<?php

namespace App\Http\Controllers;

use App\Models\discounts\discount;
use App\Models\products\barang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{

    public function index()
    {
        $barang = barang::with('diskon')->whereHas('diskon', function ($query) {
            $query->whereNotNull("kode_diskon");
        })->orderBy('created_at', 'desc')->paginate(5);

        return view("discount.discount", compact("barang"));
    }

    public function tambah_diskon(Request $request)
    {

        $kode = '';
        if ($request->jenis_discount == "persen") {
            $validator = Validator::make($request->all(), [
                'txt_product' => 'required|max:30',
                'jenis_discount' => 'required',
                'txt_nominal' => 'required',
            ], [
                'required' => 'Field wajib diisi!'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with(['tambah' => 'error tambah']);
            }

            $kode = "PE" . time();
            $barang = barang::find($request->txt_kode);
            $barang->kode_diskon = $kode;
            $barang->save();

            discount::create([
                'kode_diskon' => $kode,
                'kategori' => $request->jenis_discount,
                'nominal' => $request->txt_nominal,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);
        } else if ($request->jenis_discount == "nominal") {
            $validator = Validator::make($request->all(), [
                'txt_product' => 'required|max:30',
                'jenis_discount' => 'required',
                'txt_nominal' => 'required',
            ], [
                'required' => 'Field wajib diisi!'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with(['tambah' => 'error tambah']);
            }
            $kode = "NM" . time();
            $barang = barang::find($request->txt_kode);
            $barang->kode_diskon = $kode;
            $barang->save();

            discount::create([
                'kode_diskon' => $kode,
                'kategori' => $request->jenis_discount,
                'nominal' => str_replace(".", "", $request->txt_nominal),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'txt_product' => 'required|max:30',
                'jenis_discount' => 'required',
                'jenis_free' => 'required',
                'txt_beli' => 'required',
                'txt_gratis' => 'required',
            ], [
                'required' => 'Field wajib diisi!'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with(['tambah' => 'error tambah']);
            }
            $kode = "FR" . time();
            $barang = barang::find($request->txt_kode);
            $barang->kode_diskon = $kode;
            $barang->save();


            discount::create([
                'kode_diskon' => $kode,
                'kategori' => $request->jenis_discount,
                'free_product' => $request->jenis_free,
                'buy' => $request->txt_beli,
                'free' => $request->txt_gratis,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        alert()->success('Berhasil', 'Berhasil Menambahkan Data');
        return redirect('/diskon');
    }

    public function update_diskon(Request $request)
    {
        if ($request->jenis_discount_update == "persen") {
            $validator = Validator::make($request->all(), [
                'txt_product_update' => 'required|max:30',
                'jenis_discount_update' => 'required',
                'txt_nominal_update' => 'required',
            ], [
                'required' => 'Field wajib diisi!'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with(['update' => 'error update']);
            }

            $diskon = discount::find($request->txt_kode_update);
            $diskon->kategori = $request->jenis_discount_update;
            $diskon->nominal = str_replace(".", "", $request->txt_nominal_update);
            $diskon->free_product = null;
            $diskon->updated_at = Carbon::now();
            $diskon->save();
        } else if ($request->jenis_discount_update == "nominal") {
            $validator = Validator::make($request->all(), [
                'txt_product_update' => 'required|max:30',
                'jenis_discount_update' => 'required',
                'txt_nominal_update' => 'required',
            ], [
                'required' => 'Field wajib diisi!'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with(['update' => 'error update']);
            }

            $diskon = discount::find($request->txt_kode_update);
            $diskon->kategori = $request->jenis_discount_update;
            $diskon->nominal = str_replace(".", "", $request->txt_nominal_update);
            $diskon->free_product = null;
            $diskon->updated_at = Carbon::now();
            $diskon->save();
        } else {
            $validator = Validator::make($request->all(), [
                'txt_product_update' => 'required|max:30',
                'jenis_discount_update' => 'required',
                'jenis_free_update' => 'required',
                'txt_beli_update' => 'required',
                'txt_gratis_update' => 'required',
            ], [
                'required' => 'Field wajib diisi!'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with(['update' => 'error update']);
            }

            $diskon = discount::find($request->txt_kode_update);
            $diskon->kategori = $request->jenis_discount_update;
            $diskon->nominal = null;
            $diskon->free_product = $request->jenis_free_update;
            $diskon->buy = $request->txt_beli_update;
            $diskon->free = $request->txt_gratis_update;
            $diskon->updated_at = Carbon::now();
            $diskon->save();
        }

        alert()->success('Berhasil', 'Berhasil Mengubah Data');
        return redirect('/diskon');
    }

    public function delete_selected(Request $request)
    {
        foreach ($request->ids as $value) {
            discount::find($value)->delete();
            barang::where('kode_diskon', $value)->update([
                'kode_diskon' => null,
            ]);
        }
        alert()->success('Berhasil', 'Berhasil Menghapus Data');
        return redirect('/diskon');
    }

    public function delete($kode, Request $request)
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


                $diskon = discount::find($kode);
                $diskon->delete();

                barang::where('kode_diskon', $kode)->update([
                    'kode_diskon' => null,
                ]);

                alert()->success('Berhasil', 'Berhasil Menghapus Data');
                return redirect('/diskon');
            } else {
                alert()->warning('Informasi', 'Token tidak sesuai');
                return redirect('/diskon');
            }
        } else {
            alert()->warning('Informasi', 'Token tidak ditemukan');
            return redirect('/diskon');
        }
    }

    public function filter_kategori(Request $request)
    {
        if ($request->has('value')) {
            $barang = barang::with('diskon')
                ->whereHas('diskon', function ($query) use ($request) {
                    $query
                        ->whereNotNull("kode_diskon")
                        ->where("kategori", "=", $request->value);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(5);

            $barang->appends(array(
                'value' => $request->value
            ));

            return view('discount.discount', compact('barang'));
        } else {
            return redirect('/diskon');
        }
    }

    public function filter_search(Request $request)
    {
        if ($request->has('find')) {
            $barang = barang::with('diskon')
                ->whereHas('diskon', function ($query) use ($request) {
                    $query
                        ->whereNotNull("kode_diskon");
                })
                ->where('nama_br', 'LIKE', '%' . $request->find . '%')
                ->orWhere("kode_diskon", "=", $request->find)
                ->orderBy('created_at', 'desc')
                ->paginate(5);

            $barang->appends(array(
                'find' => $request->find
            ));

            return view('discount.discount', compact('barang'));
        } else {
            return redirect('/diskon');
        }
    }
}
