<?php

namespace App\Exports;

use App\Models\riwayat\transaksi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RiwayatExport implements FromCollection, WithColumnFormatting, WithStyles, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $kategori;

    public function __construct(Request $kategori)
    {
        $this->kategori = $kategori;
    }

    public function collection()
    {
        $data = function () {
            if ($this->kategori->segment(3) == 'filter') {
                $json = json_decode(base64_decode($this->kategori->segment(4)));
                if ($json->type == 'harian') {
                    return transaksi::whereDate('tanggal', '=', $json->data)
                        ->orderBy('tanggal', 'desc')
                        ->get();
                } else if ($json->type == 'mingguan') {
                    // set range date for between sql
                    $start_date = Carbon::parse((string)$json->data)->startOfWeek();
                    $end_date = Carbon::parse((string)$json->data)->endOfWeek();

                    return transaksi::whereBetween('tanggal', [$start_date, $end_date])
                        ->orderBy('tanggal', 'desc')
                        ->get();
                } else if ($json->type == 'bulanan') {
                    $tahun = $json->data->tahun;
                    $bulan = $json->data->bulan;

                    return transaksi::whereMonth('tanggal', '=', $bulan)
                        ->whereYear('tanggal', '=', $tahun)
                        ->orderBy('tanggal', 'desc')
                        ->get();
                } else if ($json->type == 'tahunan') {
                    $tahun = $json->data->tahun;

                    return transaksi::whereYear('tanggal', '=', $tahun)
                        ->orderBy('tanggal', 'desc')
                        ->get();
                } else if ($json->type == 'range') {
                    $date_awal = $json->data->awal;
                    $date_akhir = $json->data->akhir;
                    
                    return transaksi::whereBetween('tanggal', [$date_awal, $date_akhir])
                        ->orderBy('tanggal', 'desc')
                        ->get();
                }
            } else if ($this->kategori->segment(3) == 'search') {
                return transaksi::where('kode_tr', '=', $this->kategori->segment(4))
                    ->orderBy('tanggal', 'desc')
                    ->get();
            } 

            return transaksi::orderBy('tanggal', 'desc')->get();
        };

        $data_riwayat = $data();

        return new Collection(
            [
                ["No Transaksi", "Total", "Bayar", "Voucher", "Jenis Voucher", "Nama Kasir", "Kembalian", "Tanggal", "Jenis Pembayaran"],
                $data_riwayat
            ]
        );
    }

    public function columnFormats(): array
    {
        return [
            'B' => '#,##0',
            'C' => '#,##0',
            'D' => '#,##0',
            'G' => '#,##0',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
