<?php

namespace App\Http\Controllers;

use App\Models\products\barang;
use App\Models\products\detail_barang_tag;
use App\Models\products\tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class MasterDataProduct extends Controller
{

    public function filter_tags(Request $request)
    {
        try {
            //code...
            $products = barang::with('detail_barang_tag.tag')
                ->orderBy('kode_br', 'desc')
                ->whereHas('detail_barang_tag', function ($query) use ($request) {
                    if ($request->has('filter')) {
                        $query->whereIn('kode_tag', json_decode(strtoupper($request->filter)));
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

        $tags = tag::all();

        return view('master.data_product', compact('products', 'tags'));
    }

    public function filter_search(Request $request)
    {
        $products = barang::with('detail_barang_tag.tag')
            ->where('nama_br', 'LIKE', '%' . $request->find . '%')
            ->orderBy('kode_br', 'desc')
            ->paginate(5);


        if ($request->has('find')) {
            $products->appends(array(
                'find' => $request->find
            ));
        }

        $tags = tag::all();

        return view('master.data_product', compact('products', 'tags'));
    }

    public function filter_kategori(Request $request)
    {
        $products = barang::with('detail_barang_tag.tag')
            ->where('kategori', '=', $request->select)
            ->orderBy('kode_br', 'desc')
            ->paginate(5);


        if ($request->has('select')) {
            $products->appends(array(
                'select' => $request->select
            ));
        }

        $tags = tag::with('detail_barang_tag.barang')
            ->whereHas('detail_barang_tag.barang', function ($query) use ($request) {
                if ($request->has('select')) {
                    $query->where('barang.kategori', '=', $request->select);
                }
            })
            ->get(['kode_tag', 'nama_tag']);


        return view('master.data_product', compact('products', 'tags'));
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
                return "Token sesuai, kode barangnya : " . $kode;
            } else {
                return "Token tidak sesuai, yahaha hayuk";
            }
        } else {
            return "Tidak ada token";
        }
    }

    public function delete_selected(Request $request)
    {
        dd($request);
    }

    public function products(Request $request)
    {

        // echo barang::all()->sortByDesc('kode_barang_tag')->first()->kode_barang_tag;
        // $products = barang::with('barang_tag')
        //     ->get();
        $products = barang::with('detail_barang_tag.tag')
            ->orderBy('kode_br', 'desc')
            ->paginate(5);


        // return $products;
        // $tags = barang::join('barang_tag', 'barang_tag.kode_barang_tag', '=', 'barang.kode_barang_tag')
        //     ->join('detail_barang_tag', 'detail_barang_tag.detail_kode_barang_tag', '=', 'barang_tag.detail_kode_barang_tag')
        //     ->join('tag', 'tag.kode_tag', '=', 'detail_barang_tag.kode_tag')
        //     ->get('*');

        // return $tags;
        $tags = tag::all();

        return view('master.data_product', compact('products', 'tags'));
    }

    public function add_products(Request $request)
    {
        $this->validate($request, [
            'txt_nama' => 'required|max:30',
            'txt_warna' => 'required',
            'txt_kategori' => 'required',
            'txt_ukuran' => 'required',
            'txt_harga' => 'required',
            'tags' => 'required',
            'foto' => 'required|image|mimes:jpg,png,jpeg',
            'jenis' => 'required'

        ], [
            'required' => 'Field :attribute wajib diisi!'
        ]);

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
            'gambar' => 'uploads/products/' . $nama_gambar,
            'harga' => $request->txt_harga,
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


        return redirect()->route('product');
    }

    public function update_product(Request $request)
    {
        if ($request->hasFile('foto')) {
            $this->validate($request, [
                'id' => 'required',
                'txt_nama' => 'required|max:30',
                'txt_warna' => 'required',
                'txt_kategori' => 'required',
                'txt_ukuran' => 'required',
                'txt_harga' => 'required',
                'foto' => 'required|image|mimes:jpg,png,jpeg',
                'tags' => 'required',
                'jenis' => 'required'

            ], [
                'required' => 'Field :attribute wajib diisi!'
            ]);



            $products = barang::find($request->id);
            if (File::exists($products->gambar)) {
                File::delete($products->gambar);
            }

            $foto = $request->file('foto');
            if ($foto) {
                $nama_gambar = 'foto_product-' . time() . '.' . $foto->getClientOriginalExtension();
                Image::make($foto)->resize(512, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('uploads/products/' . $nama_gambar);
            }

            $products->nama_br = $request->txt_nama;
            $products->warna = $request->txt_warna;
            $products->kategori = $request->txt_kategori;
            $products->ukuran = $request->txt_ukuran;
            $products->harga = $request->txt_harga;
            $products->gambar = 'uploads/products/' . $nama_gambar;
            $products->jenis = $request->jenis;
            $products->updated_at = Carbon::now();

            $products->save();

            $detail_tag = detail_barang_tag::where('detail_kode_barang_tag', '=', $products->kode_barang_tag);
            $detail_tag->delete();

            foreach ($request->tags as $value) {
                # code...
                detail_barang_tag::create([
                    'detail_kode_barang_tag' => $products->kode_barang_tag,
                    'kode_tag' => $value
                ]);
            }
        } else {
            $this->validate($request, [
                'id' => 'required',
                'txt_nama' => 'required|max:30',
                'txt_warna' => 'required',
                'txt_kategori' => 'required',
                'txt_ukuran' => 'required',
                'txt_harga' => 'required',
                'tags' => 'required',
                'jenis' => 'required'

            ], [
                'required' => 'Field :attribute wajib diisi!'
            ]);


            $products = barang::find($request->id);
            $products->nama_br = $request->txt_nama;
            $products->warna = $request->txt_warna;
            $products->kategori = $request->txt_kategori;
            $products->ukuran = $request->txt_ukuran;
            $products->harga = $request->txt_harga;
            $products->jenis = $request->jenis;
            $products->updated_at = Carbon::now();

            $products->save();

            $detail_tag = detail_barang_tag::where('detail_kode_barang_tag', '=', $products->kode_barang_tag);
            $detail_tag->delete();

            foreach ($request->tags as $value) {
                # code...
                detail_barang_tag::create([
                    'detail_kode_barang_tag' => $products->kode_barang_tag,
                    'kode_tag' => $value
                ]);
            }
        }
        return redirect()->back()->with('success', "Berhasil Mengubah Data");
    }
}
