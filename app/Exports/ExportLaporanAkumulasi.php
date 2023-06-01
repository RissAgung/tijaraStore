<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ExportLaporanAkumulasi implements FromCollection, ShouldAutoSize, WithColumnFormatting
{
  /**
   * @return \Illuminate\Support\Collection
   */

  protected $kategori;

  public function columnFormats(): array
    {
        return [
            'A' => '#,##0',
            'B' => '#,##0',
        ];
    }

  public function __construct(Request $kategori)
  {
    $this->kategori = $kategori->segment(3);
  }
  public function collection()
  {
    $data = base64_decode($this->kategori);
    return new Collection(
      [
        ["Pemasukan", "Pengeluaran"],
        [json_decode($data)]
      ]
    );
  }
}
