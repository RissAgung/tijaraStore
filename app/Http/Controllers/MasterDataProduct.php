<?php

namespace App\Http\Controllers;

use App\Models\products\barang;
use App\Models\products\detail_barang_tag;
use App\Models\products\tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class MasterDataProduct extends Controller
{

    public function filter_tags(Request $request)
    {
        try {
            $tagf = base64_decode($request->filter);
            // dd($tagf);  
            //code...
            $products = barang::with('detail_barang_tag.tag')
                ->with('diskon')
                ->orderBy('created_at', 'desc')
                ->whereHas('detail_barang_tag', function ($query) use ($tagf, $request) {
                    if ($request->has('filter')) {
                        $query->whereIn('kode_tag', json_decode(strtoupper($tagf)));
                    }
                })
                ->paginate(5);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/product');
        }

        if ($request->has('filter')) {
            $products->appends(array(
                'filter' => $request->filter
            ));
        }

        $all_tags = tag::all();
        $tags = tag::all();

        return view('master.data_product', compact('products', 'tags', 'all_tags'));
    }

    public function filter_search(Request $request)
    {
        $products = barang::with('detail_barang_tag.tag')
            ->with('diskon')
            ->where('nama_br', 'LIKE', '%' . $request->find . '%')
            ->orWhere('kode_br', '=', $request->find)
            ->orderBy('created_at', 'desc')
            ->paginate(5);


        if ($request->has('find')) {
            $products->appends(array(
                'find' => $request->find
            ));
        }

        $all_tags = tag::all();
        $tags = tag::all();

        return view('master.data_product', compact('products', 'tags', 'all_tags'));
    }

    public function filter_kategori(Request $request)
    {
        $products = barang::with('detail_barang_tag.tag')
            ->with('diskon')
            ->where('kategori', '=', $request->select)
            ->orderBy('created_at', 'desc')
            ->paginate(5);


        if ($request->has('select')) {
            $products->appends(array(
                'select' => $request->select
            ));
        }

        $all_tags = tag::all();
        $tags = tag::with('detail_barang_tag.barang')
            ->whereHas('detail_barang_tag.barang', function ($query) use ($request) {
                if ($request->has('select')) {
                    $query->where('barang.kategori', '=', $request->select);
                }
            })
            ->get(['kode_tag', 'nama_tag']);


        return view('master.data_product', compact('products', 'tags', 'all_tags'));
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
                $products = barang::find($kode);
                if (File::exists("uploads/products/" . $products->gambar)) {
                    File::delete("uploads/products/" . $products->gambar);
                }
                barang::find($kode)->delete();

                alert()->success('Berhasil', 'Berhasil Menghapus Data');
                return redirect()->route('product');
            } else {
                alert()->warning('Informasi', 'Token tidak sesuai');
                return redirect()->route('product');
            }
        } else {
            alert()->warning('Informasi', 'Token tidak ditemukan');
            return redirect()->route('product');
        }
    }

    public function delete_selected(Request $request)
    {
        foreach ($request->ids as $value) {
            $products = barang::find($value);
            if (File::exists("uploads/products/" . $products->gambar)) {
                File::delete("uploads/products/" . $products->gambar);
            }

            barang::find($value)->delete();
        }
        alert()->success('Berhasil', 'Berhasil Menghapus Data');
        return redirect()->route('product');
    }

    public function products(Request $request)
    {

        $products = barang::with('detail_barang_tag.tag')
            ->with('diskon')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $all_tags = tag::all();
        $tags = tag::all();

        return view('master.data_product', compact('products', 'tags', 'all_tags'));
    }

    public function add_products(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'txt_nama' => 'required|max:30',
            'txt_warna' => 'required',
            'txt_kategori' => 'required',
            'txt_ukuran' => 'required',
            'txt_harga' => 'required',
            'tags' => 'required',
            'foto' => 'required|image|mimes:jpg,png,jpeg',
            'jenis' => 'required'

        ], [
            'required' => 'Field wajib diisi!'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['tambah' => 'error tambah']);
        }

        $kode = time();
        // $kode = (barang::all()->sortByDesc('kode_barang_tag')->first()->kode_br + 1);

        $foto = $request->file('foto');
        if ($foto) {
            $nama_gambar = 'foto_product-' . time() . '.' . $foto->getClientOriginalExtension();
            Image::make($foto)->resize(512, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploads/products/' . $nama_gambar);
        }

        barang::create([
            'kode_br' => $kode,
            'kategori' => $request->txt_kategori,
            'kode_barang_tag' => 'D_' . $kode,
            'nama_br' => $request->txt_nama,
            'stok' => 0,
            'gambar' => $nama_gambar,
            'harga' => str_replace(".", "", str_replace("Rp. ", "", $request->txt_harga)),
            'ukuran' => $request->txt_ukuran,
            'warna' => $request->txt_warna,
            'jenis' => $request->jenis,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        foreach ($request->tags as  $value) {
            detail_barang_tag::create([
                'detail_kode_barang_tag' => 'D_' . $kode,
                'kode_tag' => $value
            ]);
        }

        alert()->success('Berhasil', 'Berhasil Menambahkan Data');
        return redirect()->route('product');
    }

    public function update_product(Request $request)
    {
        if ($request->hasFile('foto_update')) {
            $validator = Validator::make($request->all(), [
                'id_update' => 'required',
                'txt_nama_update' => 'required|max:30',
                'txt_warna_update' => 'required',
                'txt_kategori_update' => 'required',
                'txt_ukuran_update' => 'required',
                'txt_harga_update' => 'required',
                'foto_update' => 'required|image|mimes:jpg,png,jpeg',
                'tags_update' => 'required',
                'jenis_update' => 'required'
            ], [
                'required' => 'Field wajib diisi!'
            ]);

            $products = barang::find($request->id_update);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with(['update' => 'error update', 'old_gambar' => "uploads/products/" . $products->gambar]);
            }


            if (File::exists("uploads/products/" . $products->gambar)) {
                File::delete("uploads/products/" . $products->gambar);
            }

            $foto = $request->file('foto_update');
            if ($foto) {
                $nama_gambar = 'foto_product-' . time() . '.' . $foto->getClientOriginalExtension();
                Image::make($foto)->resize(512, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('uploads/products/' . $nama_gambar);
            }

            $products->nama_br = $request->txt_nama_update;
            $products->warna = $request->txt_warna_update;
            $products->kategori = $request->txt_kategori_update;
            $products->ukuran = $request->txt_ukuran_update;
            $products->harga = str_replace(".", "", str_replace("Rp. ", "", $request->txt_harga_update));
            $products->gambar = $nama_gambar;
            $products->jenis = $request->jenis_update;
            $products->updated_at = Carbon::now();

            $products->save();

            $detail_tag = detail_barang_tag::where('detail_kode_barang_tag', '=', $products->kode_barang_tag);
            $detail_tag->delete();

            foreach ($request->tags_update as $value) {
                # code...
                detail_barang_tag::create([
                    'detail_kode_barang_tag' => $products->kode_barang_tag,
                    'kode_tag' => $value
                ]);
            }
        } else {
            $validator = Validator::make($request->all(), [
                'id_update' => 'required',
                'txt_nama_update' => 'required|max:30',
                'txt_warna_update' => 'required',
                'txt_kategori_update' => 'required',
                'txt_ukuran_update' => 'required',
                'txt_harga_update' => 'required',
                'tags_update' => 'required',
                'jenis_update' => 'required'

            ], [
                'required' => 'Field wajib diisi!'
            ]);

            $products = barang::find($request->id_update);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with(['update' => 'error update', 'old_gambar' => "uploads/products/" . $products->gambar]);
            }


            $products->nama_br = $request->txt_nama_update;
            $products->warna = $request->txt_warna_update;
            $products->kategori = $request->txt_kategori_update;
            $products->ukuran = $request->txt_ukuran_update;
            $products->harga = str_replace(".", "", str_replace("Rp. ", "", $request->txt_harga_update));
            $products->jenis = $request->jenis_update;
            $products->updated_at = Carbon::now();

            $products->save();

            $detail_tag = detail_barang_tag::where('detail_kode_barang_tag', '=', $products->kode_barang_tag);
            $detail_tag->delete();

            foreach ($request->tags_update as $value) {
                # code...
                detail_barang_tag::create([
                    'detail_kode_barang_tag' => $products->kode_barang_tag,
                    'kode_tag' => $value
                ]);
            }
        }
        alert()->success('Berhasil', 'Berhasil Mengubah Data')->showConfirmButton()->focusConfirm(true);
        return redirect()->back()->with('success', "Berhasil Mengubah Data");
    }

    public function delete_tag($kode, Request $request)
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

                tag::find($kode)->delete();

                alert()->success('Berhasil', 'Berhasil Menghapus Data');
                return redirect()->route('product');
            } else {
                return redirect()->route('product');
            }
        } else {
            return redirect()->route('product');
        }
    }

    public function tambah_tag(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tag' => 'required',
        ], [
            'required' => 'Field wajib diisi!'
        ]);

        if ($validator->fails()) {
            alert()->warning('Informasi', 'Field nama tag wajib diisi');
            return redirect()->back();
        }

        $lstag = tag::where("nama_tag", "=", strtolower($request->nama_tag))->first();
        if ($lstag) {
            if (strtolower($lstag->nama_tag) == strtolower($request->nama_tag)) {
                alert()->warning('Informasi', 'Nama tag sudah ada');
                return redirect()->back();
            }
        }
        $kode = "TG" . time();
        tag::create([
            "kode_tag" => $kode,
            "nama_tag" => $request->nama_tag
        ]);
        alert()->success('Berhasil', 'Berhasil Menambah Data');
        return redirect()->back();
    }
}
