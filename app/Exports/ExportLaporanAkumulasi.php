<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportLaporanAkumulasi implements FromCollection
{
  /**
   * @return \Illuminate\Support\Collection
   */

  protected $kategori;

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
        [$data]
      ]
    );
  }
}
