<?php

namespace App\Exports;

use App\Models\riwayat\transaksi;
use Illuminate\Database\Eloquent\Collection;
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

    public function __construct($kategori)
    {
        $this->kategori = $kategori;
    }

    public function collection()
    {
        return new Collection(
            [
                ["No Transaksi", "Total", "Bayar", "Voucher", "Nama Kasir", "Kembalian", "Tanggal", "Jenis Pembayaran"],
                transaksi::all()
            ]
        );
    }

    public function columnFormats(): array
    {
        return [
            'B' => '#,##0',
            'C' => '#,##0',
            'D' => '#,##0',
            'F' => '#,##0',
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
