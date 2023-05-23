<?php

namespace App\Exports;

use App\Models\salary\gaji;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GajiExport implements FromCollection, WithColumnFormatting, WithStyles, ShouldAutoSize
{

    protected $request;
    protected $date;

    public function __construct(Request $request, $date)
    {
        $this->request = $request;
        $this->date = $date;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $dataGajiDB = function ($request, $date) use (&$search, &$ddate) {
            // filter search and date
            if ($request->query('search') !== null && $date !== null) {
                // data from filter date
                $data = json_decode(base64_decode($date));

                // set for return daraUrl
                $ddate = $date;
                $search = $request->query('search');

                // set model with filter date
                $dateType = function ($data, $search) {
                    if ($data->type === 'bulanan') {

                        // set year and month
                        $tahun = $data->data->tahun;
                        $bulan = $data->data->bulan;

                        return (
                            // search by nama pegawai + filter date bulanan
                            gaji::where('nama_pegawai', 'LIKE', '%' . $search . '%')
                            ->whereMonth('tanggal', '=', $bulan)
                            ->whereYear('tanggal', '=', $tahun)

                        );
                    } elseif ($data->type === 'tahunan') {

                        // set tahun
                        $tahun = $data->data->tahun;

                        return (

                            // search by nama pegawai + filter date tahunan
                            gaji::where('nama_pegawai', 'LIKE', '%' . $search . '%')
                            ->whereYear('tanggal', '=', $tahun)

                        );
                    }
                };
                // dd($date);
                // return model final
                return $dateType($data, $search)
                    ->select('tanggal', 'nama_pegawai', 'posisi', 'gaji_pokok', 'bonus', 'pinjaman', 'gaji_total')
                    ->orderBy('created_at', 'desc')
                    ->get();
            }

            // filter search
            if ($request->query('search') !== null) {
                // dd("dwa");
                // set for return daraUrl
                $search = $request->query('search');

                return (
                    // search by kode_retur
                    gaji::where('nama_pegawai', 'LIKE', '%' . $search . '%')
                    ->select('tanggal', 'nama_pegawai', 'posisi', 'gaji_pokok', 'bonus', 'pinjaman', 'gaji_total')
                    ->orderBy('created_at', 'desc')
                    ->get());
            }

            // filter date
            if ($date !== null) {
                // data from filter date
                $data = json_decode(base64_decode($date));

                // set for dataUrl
                $ddate = $date;

                $dateType = function ($data) {
                    if ($data->type === 'bulanan') {

                        // set tahun & bulan
                        $tahun = $data->data->tahun;
                        $bulan = $data->data->bulan;

                        return (
                            // return filter date bulanan
                            gaji::whereMonth('tanggal', '=', $bulan)
                            ->whereYear('tanggal', '=', $tahun)
                        );
                    } elseif ($data->type === 'tahunan') {

                        // set tahun
                        $tahun = $data->data->tahun;

                        // return filter date bulanan
                        return (gaji::whereYear('tanggal', '=', $tahun)
                        );
                    } elseif ($data->type === 'range') {

                        $date_awal = $data->data->awal;
                        $date_akhir = $data->data->akhir;

                        // return filter date range
                        return (gaji::whereBetween('tanggal', [$date_awal, $date_akhir])
                        );
                    }
                    // 2023-04-30'
                };

                return $dateType($data)
                ->select('tanggal', 'nama_pegawai', 'posisi', 'gaji_pokok', 'bonus', 'pinjaman', 'gaji_total')
                    ->orderBy('created_at', 'desc')
                    ->get();
            }

            $search = "";
            $ddate = "";

            return gaji::orderBy('created_at', 'desc')
                ->select('tanggal', 'nama_pegawai', 'posisi', 'gaji_pokok', 'bonus', 'pinjaman', 'gaji_total')
                ->get();
        };

        $dataGaji = $dataGajiDB($this->request, $this->date);


        return new Collection(
            [
                ["Tanggal", "Nama Pegawai", "Posisi", "Gaji Pokok", "Bonus", "Pinjaman", "Gaji Total"],
                $dataGaji
            ]
        );
    }

    public function columnFormats(): array
    {
        return [
            'D' => '#,##0',
            'E' => '#,##0',
            'F' => '#,##0',
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
