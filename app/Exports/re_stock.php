<?php

namespace App\Exports;

use App\Models\pengeluaran\pengeluaran;
use App\Models\pengeluaran\pengeluaran_barang;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class re_stock implements FromCollection, WithHeadings
{
  /**
   * @return \Illuminate\Support\Collection
   */
  public function collection()
  {

    return collect(pengeluaran::where('jenis_pengeluaran', 'restock')->get());
  }

  public function headings(): array
  {
    return [
      'kode',
      'tanggal',
      'nama',
      'nama_barang',
      'jumlah',
      'total'
    ];
  }
}
