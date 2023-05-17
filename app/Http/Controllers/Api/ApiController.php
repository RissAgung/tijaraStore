<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\products\barang;
use App\Models\riwayat\transaksi;
use App\Models\voucher\voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        
        if (!$request->apikey) {
            return $this->sendError('API Key tidak ada');
        } else {
            if ($this->apikey === $request->apikey) {
                return response()->json(
                    [
                        'status' => 'success',
                        'tanggal' => Carbon::now()->format('Y-m-d'),
                        'result' => transaksi::whereDate('tanggal', '=', Carbon::now())
                            ->selectRaw('SUM(total) as total')
                            ->first()
                            ->total
                    ]
                );
            }
        }

        return $this->sendError('API Key tidak sesuai');
    }

    public function sendError($text): array
    {
        return array(
            'status' => 'Error',
            'message' => $text,
        );
    }
}
