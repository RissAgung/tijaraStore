<?php

namespace App\Http\Controllers;

use App\Exports\RiwayatExport;
use App\Models\riwayat\transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = transaksi::with('detail_transaksi.detail_diskon_transaksi')
            ->with('detail_transaksi.barang')
            ->orderBy('tanggal', 'desc')
            ->paginate(6);

        return view('riwayat.riwayat', compact('data'));
    }

    public function filter($data = null)
    {
        if ($data == '') {
            return redirect('/riwayat');
        }

        try {
            $data = json_decode(base64_decode($data));

            if ($data->type === 'harian') {
                $data = transaksi::with('detail_transaksi.detail_diskon_transaksi')
                    ->with('detail_transaksi.barang')
                    ->whereDate('tanggal', '=', $data->data)
                    ->orderBy('tanggal', 'desc')
                    ->paginate(6);
            } else if ($data->type === 'mingguan') {
                // set range date for between sql
                $start_date = Carbon::parse((string)$data->data)->startOfWeek();
                $end_date = Carbon::parse((string)$data->data)->endOfWeek();
    
                $data = transaksi::with('detail_transaksi.detail_diskon_transaksi')
                    ->with('detail_transaksi.barang')
                    ->whereBetween('tanggal', [$start_date, $end_date])
                    ->orderBy('tanggal', 'desc')
                    ->paginate(6);
            } else if ($data->type === 'bulanan') {
                // set tahun & bulan
                $tahun = $data->data->tahun;
                $bulan = $data->data->bulan;
    
                $data = transaksi::with('detail_transaksi.detail_diskon_transaksi')
                    ->with('detail_transaksi.barang')
                    ->whereMonth('tanggal', '=', $bulan)
                    ->whereYear('tanggal', '=', $tahun)
                    ->orderBy('tanggal', 'desc')
                    ->paginate(6);
            } else if ($data->type === 'tahunan') {
                // set tahun
                $tahun = $data->data->tahun;
    
                $data = transaksi::with('detail_transaksi.detail_diskon_transaksi')
                    ->with('detail_transaksi.barang')
                    ->whereYear('tanggal', '=', $tahun)
                    ->orderBy('tanggal', 'desc')
                    ->paginate(6);
            } else if ($data->type === 'range') {
                $date_awal = $data->data->awal;
                $date_akhir = $data->data->akhir;
    
                $data = transaksi::with('detail_transaksi.detail_diskon_transaksi')
                    ->with('detail_transaksi.barang')
                    ->whereBetween('tanggal', [$date_awal, $date_akhir])
                    ->orderBy('tanggal', 'desc')
                    ->paginate(6);
            }
    
            return view('riwayat.riwayat', compact('data'));
        } catch (\Throwable $th) {
            return redirect('/riwayat');
        }

        
    }

    public function search($data = null)
    {
        if ($data == '') {
            return redirect('/riwayat');
        }

        $data = transaksi::with('detail_transaksi.detail_diskon_transaksi')
            ->with('detail_transaksi.barang')
            ->where('kode_tr', '=', $data)
            ->orderBy('tanggal', 'desc')
            ->paginate(6);

        return view('riwayat.riwayat', compact('data'));
    }

    public function export(Request $request)
    {
        if ($request->kategori != '') {
            return $request->kategori;
        }

        return Excel::download(new RiwayatExport($request->kategori), 'riwayat.xlsx');
    }
}
