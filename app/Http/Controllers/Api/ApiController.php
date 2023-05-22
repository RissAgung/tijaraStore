<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\model_pegawai;
use App\Models\products\barang;
use App\Models\retur\customer;
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
                if($request->segment(4)){
                    return response()->json(
                        barang::with('diskon')
                            ->where('kode_br', $request->segment(4))
                            ->get()
                    );
                }
                return response()->json(
                    barang::with('diskon')
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
                return response()->json(
                    barang::with('diskon')
                        ->where("jenis", "=", "free")
                        ->get()
                );
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
        // return "anjing";
        // $dataLogin = $request->validate([
        //     'username' => 'required',
        //     'password' => 'required'
        // ]);

        $dataLogin = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if($dataLogin->fails()){
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
                if($user){

                    if(Hash::check($request->password, $user->password)){
                        $pegawai = model_pegawai::where('kode_pegawai', $user->kode_pegawai)->first();
                        return response()->json(
                            [
                                "status" => "success",
                                "message" => "Login Berhasil",
                                "data" => [
                                    "nama" => $pegawai->nama,
                                ]
                            ],
                        );
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

    public function detail_transaksi(Request $request, $kode_tr = null){
        if (!$request->apikey) {
            return $this->sendError('API Key tidak ada');
        } else {
            if ($this->apikey === $request->apikey) {
                if($kode_tr){

                    $cekretur = customer::where('kode_tr', $kode_tr)->first();

                    if($cekretur){
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
                    
                    if($riwayat){
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
                    [
                        
                    ]
                );
            }
        }

        return $this->sendError('API Key tidak sesuai');
    }

    public function input_retur_customer(Request $request){
        

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
        
                if($validate->fails()){
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
                if($request->kode_br_keluar){
                    $retur->kode_br_keluar = $request->kode_br_keluar;
                }
                if($request->bayar_kurang){
                    $retur->bayar_kurang = $request->bayar_kurang;
                }
                if($request->kembalian_tunai){
                    $retur->kembalian_tunai = $request->kembalian_tunai;
                }
                if($request->bayar_tunai){
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

    public function sendError($text)
    {
        return Response()->json(array(
            'status' => 'Error',
            'message' => $text,
        ));
    }
}
