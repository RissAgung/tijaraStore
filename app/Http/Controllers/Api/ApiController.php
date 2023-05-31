<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\model_pegawai;
use App\Models\products\barang;
use App\Models\retur\customer;
use App\Models\riwayat\detail_diskon_transaksi;
use App\Models\riwayat\detail_transaksi;
use App\Models\riwayat\transaksi;
use App\Models\User;
use App\Models\voucher\voucher;
use Carbon\Carbon;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    protected $apikey = 'DWuqUHWDUhDQUDadaq';

    public function product_nodiscount(Request $request)
    {
        if (!$request->apikey) {
            return $this->sendError('API Key tidak ada');
        } else {
            if ($this->apikey === $request->apikey) {
                return response()->json([
                    barang::whereNull("kode_diskon")
                        ->where("kategori", "=", "pria")
                        ->where("jenis", "=", "jual")
                        ->where("nama_br", "LIKE", "%" . $request->search . "%")
                        ->get(),
                    barang::whereNull("kode_diskon")
                        ->where("kategori", "=", "wanita")
                        ->where("jenis", "=", "jual")
                        ->where("nama_br", "LIKE", "%" . $request->search . "%")
                        ->get(),
                    barang::whereNull("kode_diskon")
                        ->where("kategori", "=", "anak")
                        ->where("jenis", "=", "jual")
                        ->where("nama_br", "LIKE", "%" . $request->search . "%")
                        ->get(),
                ]);
            }
        }

        return $this->sendError('API Key tidak sesuai');
    }

    public function product(Request $request)
    {
        if (!$request->apikey) {
            return $this->sendError('API Key tidak ada');
        } else {
            if ($this->apikey === $request->apikey) {
                return response()->json(
                    barang::with('diskon')
                        ->get()
                );
            }
        }

        return $this->sendError('API Key tidak sesuai');
    }

    public function product_jual(Request $request)
    {
        if (!$request->apikey) {
            return $this->sendError('API Key tidak ada');
        } else {
            if ($this->apikey === $request->apikey) {
                if ($request->segment(4)) {
                    return response()->json(
                        barang::with('diskon')
                            ->where('stok', '>', 0)
                            ->where('jenis', '=', 'jual')
                            ->where('kode_br', $request->segment(4))
                            ->get()
                    );
                }
                return response()->json(
                    barang::with('diskon')
                        ->where('stok', '>', 0)
                        ->where('jenis', '=', 'jual')
                        ->get()
                );
            }
        }

        return $this->sendError('API Key tidak sesuai');
    }

    public function product_free(Request $request)
    {
        if (!$request->apikey) {
            return $this->sendError('API Key tidak ada');
        } else {
            if ($this->apikey === $request->apikey) {
                if ($request->segment(4)) {
                    return response()->json(
                        barang::with('diskon')
                            ->where('stok', '>', 0)
                            ->where("kode_br", '=', $request->segment(4))
                            ->where("jenis", "=", "free")
                            ->get()
                    );
                } else {
                    return response()->json(
                        barang::with('diskon')
                            ->where('stok', '>', 0)
                            ->where("jenis", "=", "free")
                            ->get()
                    );
                }
            }
        }

        return $this->sendError('API Key tidak sesuai');
    }

    public function voucher(Request $request)
    {
        if (!$request->apikey) {
            return $this->sendError('API Key tidak ada');
        } else {
            if ($this->apikey === $request->apikey) {
                return response()->json(
                    voucher::all()
                );
            }
        }

        return $this->sendError('API Key tidak sesuai');
    }

    public function voucher_kategori(Request $request)
    {
        if (!$request->apikey) {
            return $this->sendError('API Key tidak ada');
        } else {
            if ($this->apikey === $request->apikey) {
                return response()->json(
                    voucher::where('kategori', $request->segment(4))->get()
                );
            }
        }

        return $this->sendError('API Key tidak sesuai');
    }

    public function pemasukan_hari_ini(Request $request)
    {
        $currentDate = now()->toDateString();

        if (!$request->apikey) {
            return $this->sendError('API Key tidak ada');
        } else {
            if ($this->apikey === $request->apikey) {
                return response()->json(
                    [
                        'status' => 'success',
                        'tanggal' => Carbon::now()->format('Y-m-d'),
                        'result' => [
                            "total_penjualan_harian" => transaksi::whereDate('tanggal', '=', Carbon::now())
                                ->selectRaw('SUM(total) as total')
                                ->first()
                                ->total,
                            'total_pakaian_terjual' => transaksi::join('detail_transaksi', 'transaksi.kode_tr', '=', 'detail_transaksi.kode_tr')
                                ->join('barang', 'detail_transaksi.kode_br', '=', 'barang.kode_br')
                                ->selectRaw('SUM(detail_transaksi.QTY) AS total_terjual, barang.kategori')
                                ->whereDate('transaksi.tanggal', $currentDate)
                                ->groupBy('barang.kategori')
                                ->get(),

                        ]
                    ]
                );
            }
        }

        return $this->sendError('API Key tidak sesuai');
    }

    public function checkLoginMobile(Request $request)
    {

        // return response()->json(
        //     User::join('pegawai', 'account.kode_pegawai', '=', 'pegawai.kode_pegawai')->get(['account.*', 'pegawai.*'])
        // );
        // return "anjing";
        // $dataLogin = $request->validate([
        //     'username' => 'required',
        //     'password' => 'required'
        // ]);

        $dataLogin = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($dataLogin->fails()) {
            return array(
                "status" => "error",
                "message" => $dataLogin->messages()
            );
        }


        $dataUsername = $request->username;
        $dataKey = $request->apikey;

        if (!$request->apikey) {
            return $this->sendError('API Key tidak ada');
        } else {
            if ($this->apikey === $request->apikey) {

                $user = User::where('username', $dataUsername)->first();
                // return $user;
                if ($user) {
                    if (Hash::check($request->password, $user->password)) {
                        if ($user->level == 'kasir') {
                            $pegawai = model_pegawai::where('kode_pegawai', $user->kode_pegawai)->first();
                            return response()->json(
                                [
                                    "status" => "success",
                                    "message" => "Login Berhasil",
                                    "data" => $pegawai
                                ],
                            );
                        }

                        return $this->sendError('Login hanya bisa oleh user kasir');
                    }

                    return $this->sendError('Password Salah');
                }

                return $this->sendError('Username tidak ditemukan');
            }
        }

        return $this->sendError('API Key tidak sesuai');

        // $data = User::where('username', '=', $dataUsername)->first();
        // $dataPegawai = model_pegawai::where('kode_account', '=', $data->kode_account)->first();

        // if ($dataKey == $this->apikey) {
        //     if (Auth::attempt($dataLogin)) {
        //         if ($data->level == 'superadmin') {
        //             return response()->json([
        //                 'status' => 'success',
        //                 'msg' => 'Login Berhasil',
        //                 'data' => array(
        //                     'kode_pegawai' => $dataPegawai->kode_pegawai,
        //                     'nama' => $dataPegawai->nama,
        //                     'alamat' => $dataPegawai->alamat
        //                 ),
        //             ]);
        //         } else {
        //             return response()->json([
        //                 'status' => 'error',
        //                 'msg' => 'Login hanya untuk sales'
        //             ]);
        //         }
        //     } else {
        //         return response()->json([
        //             'status' => 'error',
        //             'msg' => 'Email atau password salah'
        //         ]);
        //     }
        // } else {
        //     return $this->sendError('API Key tidak ada');
        // }
    }

    public function detail_transaksi(Request $request, $kode_tr = null)
    {
        if (!$request->apikey) {
            return $this->sendError('API Key tidak ada');
        } else {
            if ($this->apikey === $request->apikey) {
                if ($kode_tr) {

                    $cekretur = customer::where('kode_tr', $kode_tr)->first();

                    if ($cekretur) {
                        return response()->json(
                            [
                                "status" => "error",
                                "message" => "Transaksi sudah pernah diretur"
                            ]
                        );
                    }

                    $riwayat = transaksi::with('detail_transaksi.barang')
                        ->with('detail_transaksi.detail_diskon_transaksi')
                        ->where('kode_tr', $kode_tr)->first();

                    if ($riwayat) {
                        return response()->json(
                            [
                                "status" => "success",
                                "message" => "Kode transaksi ditemukan",
                                "data" => $riwayat,
                            ]
                        );
                    }

                    return response()->json(
                        [
                            "status" => "error",
                            "message" => "Kode transaksi tidak ditemukan"
                        ]
                    );
                }

                return response()->json(
                    []
                );
            }
        }

        return $this->sendError('API Key tidak sesuai');
    }

    public function input_retur_customer(Request $request)
    {


        if (!$request->apikey) {
            return $this->sendError('API Key tidak ada');
        } else {
            if ($this->apikey === $request->apikey) {
                $validate = Validator::make($request->all(), [
                    'nama_pegawai' => 'required|max:20',
                    'kode_br' => 'required|max:20',
                    'kode_tr' => 'required',
                    'qty' => 'required|int',
                    'jenis_pengembalian' => 'required',
                ]);

                if ($validate->fails()) {
                    return $this->sendError($validate->messages());
                }

                $retur = new customer;
                $retur->kode_retur_cs = "RCS" . date('YmdHis');
                $retur->tanggal = Carbon::now();
                $retur->nama_pegawai = $request->nama_pegawai;
                $retur->kode_br = $request->kode_br;
                $retur->kode_tr = $request->kode_tr;
                $retur->QTY = $request->qty;
                $retur->jenis_pengembalian = $request->jenis_pengembalian;
                if ($request->kode_br_keluar) {
                    $retur->kode_br_keluar = $request->kode_br_keluar;
                }
                if ($request->bayar_kurang) {
                    $retur->bayar_kurang = $request->bayar_kurang;
                }
                if ($request->kembalian_tunai) {
                    $retur->kembalian_tunai = $request->kembalian_tunai;
                }
                if ($request->bayar_tunai) {
                    $retur->bayar_tunai = $request->bayar_tunai;
                }
                $retur->save();

                return response()->json(
                    [
                        "status" => "success",
                        "message" => "Retur customer berhasil",
                        "data" => $retur,
                    ]
                );
            }
        }

        return $this->sendError('API Key tidak sesuai');
    }

    public function submitTransaksi(Request $request)
    {


        if (!$request->apikey) {
            return $this->sendError('API Key tidak ada');
        } else {
            if ($this->apikey === $request->apikey) {
                $validate = Validator::make($request->all(), [
                    'detail_transaksi' => 'required',
                    'nama_kasir' => 'required',
                    'jenis_pembayaran' => 'required',
                    'total' => 'required',
                    'bayar' => 'required',
                    'kembalian' => 'required',
                ]);

                if ($validate->fails()) {
                    return $this->sendError($validate->messages());
                }
                


                $detail_transaksi = json_decode($request->detail_transaksi);



                $kode_tr = "TR" . date('YmdHis');

                $transaksi = new transaksi;
                $transaksi->kode_tr = $kode_tr;
                $transaksi->total = $request->total;
                $transaksi->bayar = $request->bayar;
                if ($request->has('voucher', 'jenis_voucher')) {
                    $transaksi->voucher = $request->voucher;
                    $transaksi->jenis_voucher = $request->jenis_voucher;
                }
                $transaksi->nama_kasir = $request->nama_kasir;
                $transaksi->kembalian = $request->kembalian;
                $transaksi->tanggal = Carbon::now();
                $transaksi->jenis_pembayaran = $request->jenis_pembayaran;
                $transaksi->save();
                

                for ($i = 0; $i < count($detail_transaksi); $i++) {
                    $detail = new detail_transaksi;
                    $detail->kode_tr = $kode_tr;
                    $detail->QTY = $detail_transaksi[$i]->qty;
                    $detail->subtotal = $detail_transaksi[$i]->subtotal;
                    $detail->kode_br = $detail_transaksi[$i]->kode_br;
                    if($detail_transaksi[$i]->diskon == "null"){
                        $detail->kode_diskon === null;
                        $detail->save();
                    } else {
                        
                        $kode_diskon = null;
                        $kategori = null;
                        $kategori_free = null;
                        if($detail_transaksi[$i]->diskon->kategori === "FREE_PRODUK"){
                            $kode_diskon = "FR" . date('YmdHis');
                            $kategori = "free";
                            $kategori_free = $detail_transaksi[$i]->diskon->kategori_free == "SAMA" ? "sama" : "bebas";
                        } else if($detail_transaksi[$i]->diskon->kategori === "PERSEN"){
                            $kode_diskon = "PE" . date('YmdHis');
                            $kategori = "persen";
                        } else if($detail_transaksi[$i]->diskon->kategori === "NOMINAL"){
                            $kode_diskon = "NM" . date('YmdHis');
                            $kategori = "nominal";
                        }
                        $detail->kode_diskon == $kode_diskon;

                        $detail_diskon_transaksi = new detail_diskon_transaksi;
                        $detail_diskon_transaksi->kode_diskon = $kode_diskon;
                        $detail_diskon_transaksi->kategori = $kategori;
                        if($kategori_free){
                            $detail_diskon_transaksi->free_product = $kategori_free;
                        }
                        
                        if($detail_transaksi[$i]->diskon->kategori === "FREE_PRODUK"){
                            $detail_diskon_transaksi->buy = $detail_transaksi[$i]->diskon->buy;
                            $detail_diskon_transaksi->free = $detail_transaksi[$i]->diskon->free;
                        } else if($detail_transaksi[$i]->diskon->kategori === "PERSEN"){
                            $detail_diskon_transaksi->nominal = $detail_transaksi[$i]->diskon->nominal;
                        } else if($detail_transaksi[$i]->diskon->kategori === "NOMINAL"){
                            $detail_diskon_transaksi->nominal = $detail_transaksi[$i]->diskon->nominal;
                        }

                        $detail->kode_diskon = $kode_diskon;
                        $detail->save();

                        $detail_diskon_transaksi->save();

                    }
                    
                }

                return response()->json(
                    [
                        "status" => "success",
                        "message" => "Transaksi Berhasil",
                        "data" => $transaksi,
                    ]
                );
            }
        }

        return $this->sendError('API Key tidak sesuai');
    }

    public function sendError($text)
    {
        return Response()->json(array(
            'status' => 'error',
            'message' => $text,
        ));
    }
}
