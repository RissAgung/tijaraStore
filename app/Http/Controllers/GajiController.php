<?php

namespace App\Http\Controllers;

use App\Models\salary\employee;
use Illuminate\Http\Request;
use App\Models\salary\gaji;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class GajiController extends Controller
{
    public function index(Request $request, $date = null)
    {
    //     $gaji = gaji::orderBy('created_at', 'desc')
    //     ->paginate(5);        

    //    return view('salary.gaji', compact('gaji'));
  
      // data for table
      $dataGajiDB = function ($request, $date) use (&$search, &$ddate) {
  
        // filter search and date
        if ($request->search !== null && $date !== null) {
  
          // data from filter date
          $data = json_decode(base64_decode($date));
  
          // set for return daraUrl
          $ddate = $date;
          $search = $request->search;
  
          // set model with filter date
          $dateType = function ($data, $search) {
            if ($data->type === 'harian') {
  
              return (
                // search by nama pegawai + filter date harian 
                gaji::where('nama_pegawai', 'LIKE', '%' . $search . '%')
                ->whereDate('tanggal', '=', $data->data)
              );
            } elseif ($data->type === 'mingguan') {
  
              // set range date for between sql
              $start_date = Carbon::parse((string)$data->data)->startOfWeek();
              $end_date = Carbon::parse((string)$data->data)->endOfWeek();
  
              return (
                // search by nama_pegawai + filter date mingguan 
                gaji::where('nama_pegawai', 'LIKE', '%' . $search . '%')
                ->whereBetween('tanggal', [$start_date, $end_date])
  
              );
              // return dd($start_date->toDateString() . " - " . $end_date->toDateString());
            } elseif ($data->type === 'bulanan') {
  
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
  
          // return model final
          return $dateType($data, $search)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        }
  
        // filter search
        if ($request->search !== null) {
  
          // set for return daraUrl
          $search = $request->search;
  
          return (
            // search by kode_retur
            gaji::where('nama_pegawai', 'LIKE', '%' . $search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10));
        }
  
        // filter date
        if ($date !== null) {
  
          // data from filter date
          $data = json_decode(base64_decode($date));
  
          // set for dataUrl
          $ddate = $date;
  
          $dateType = function ($data) {
            if ($data->type === 'harian') {
              return (gaji::whereDate('tanggal', '=', $data->data)); // return filter date harian
  
            } elseif ($data->type === 'mingguan') {
  
              // set range date for between sql
              $start_date = Carbon::parse((string)$data->data)->startOfWeek();
              $end_date = Carbon::parse((string)$data->data)->endOfWeek();
  
              return (gaji::whereBetween('tanggal', [$start_date, $end_date])); // return filter date mingguan
  
            } elseif ($data->type === 'bulanan') {
  
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
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        }
  
        $search = "";
        $ddate = "";
  
        return gaji::orderBy('created_at', 'desc')
          ->paginate(10);
      };
  
      $dataGaji = $dataGajiDB($request, $date);
  
      if ($request->has('search')) {
        $dataGaji->appends(array(
          'search' => $request->search
        ));
      }
  
      $dataUrl = array(
        "search" => $search,
        "date" => $ddate
      );
  
      return view("salary.gaji", compact("dataGaji", "dataUrl"));
      // dd($dataRetur);
    }
    

    public function search_gaji(Request $request)
    {
        $gaji = gaji::where('nama_pegawai', 'LIKE', '%' . $request->find . '%')
            ->paginate(5);  


        if ($request->has('find_gaji')) {
            $gaji->appends(array(
                'find_gaji' => $request->find
            ));
        }

        return view('salary.gaji', compact('gaji'));
    }

    public function add_gaji(Request $request){

        $this->validate($request, [
            'admin' => 'required',
            'kasir' => 'required',
            'pegawai' => 'required'
        ], [
            'required' => 'Field Wajib Diisi!'
        ]);            
      
        
        $data_pegawai = employee::with('account')->get();

        $pegawai = [];
        $admin =  [];
        $kasir = [];
        
        foreach($data_pegawai as $index){

            // pegawai biasa
            if($index->account === null){
                array_push($pegawai, $index);
            }elseif($index->account && $index->account->level === 'admin'){
                array_push($admin, $index);
            } elseif($index->account && $index->account->level === 'kasir'){
                array_push($kasir, $index);
            }
        }
     
        $rangePegawai = count($pegawai);
        $rangeAdmin = count($admin);
        $rangeKasir = count($kasir);
        $initial = 1;

        $Month = Carbon::now()->month; //cek data bulan ini
        $Year = Carbon::now()->year; //cek data tahun ini
        //cek apakah sdh ada data gaji bulan dn tahun ini     
        $dateExist = gaji::whereMonth('tanggal', $Month)
                            ->whereYear('tanggal', $Year)
                            ->exists();
        //jika data sdh ada maka kembali ke halaman awal 
        if($dateExist) { 
          alert()->error('Gagal', 'Data gaji bulan ini sudah ada');   
            return redirect()->back();
        }


        if($rangePegawai != 0){
                foreach($pegawai as $data){                    
                    $kode = time() . $initial ;
                    gaji::create([
                        'kode_gaji' => $kode,
                        'tanggal' => Carbon::today(),
                        'nama_pegawai' => $data->nama,
                        'posisi' => "pegawai",
                        'gaji_pokok' => str_replace(".", "", str_replace("Rp. ", "", $request->pegawai)),
                        'bonus' => 0,
                        'pinjaman' => 0,
                        'gaji_total' => str_replace(".", "", str_replace("Rp. ", "", $request->pegawai)),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    $initial += 1;
                }
        } 

        if($rangeAdmin != 0){
            foreach($admin as $data){                    
                $kode = time() . $initial ;
                gaji::create([
                    'kode_gaji' => $kode,
                    'tanggal' => Carbon::today(),
                    'nama_pegawai' => $data->nama,
                    'posisi' => "Admin",
                    'gaji_pokok' =>str_replace(".", "", str_replace("Rp. ", "", $request->admin)),
                    'bonus' => 0,
                    'pinjaman' => 0,
                    'gaji_total' =>str_replace(".", "", str_replace("Rp. ", "", $request->admin)),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                $initial += 1;
            }
            
        }
        
        if($rangeKasir != 0){
            foreach($kasir as $data){                    
                $kode = time() . $initial ;
                gaji::create([
                    'kode_gaji' => $kode,
                    'tanggal' => Carbon::today(),
                    'nama_pegawai' => $data->nama,
                    'posisi' => "Kasir",
                    'gaji_pokok' => str_replace(".", "", str_replace("Rp. ", "", $request->kasir)),
                    'bonus' => 0,
                    'pinjaman' => 0,
                    'gaji_total' => str_replace(".", "", str_replace("Rp. ", "", $request->kasir)),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                $initial += 1;
            }
            
        } 

        alert()->success('Berhasil', 'Berhasil Menambahkan Data');    
        return redirect('/salary');
    }
    

    public function edit_gaji(Request $request){
        $validator = Validator::make($request->all(), [
            'id_gajiUpdate' => 'required',
            'total' => 'required'
        ], [
            'required' => 'Field wajib diisi!'
        ]);

        $salary = gaji::find($request->id_gajiUpdate);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['update' => 'error update']);
        }
       
        $salary->bonus =  str_replace(".", "", str_replace("Rp. ", "", $request->bonus));
        $salary->pinjaman =  str_replace(".", "", str_replace("Rp. ", "", $request->pinjaman));
        $salary->gaji_total = str_replace(".", "", str_replace("Rp. ", "", $request->total));
        $salary->updated_at = Carbon::now();

        $salary->save();

        alert()->success('Berhasil', 'Berhasil Mengubah Data');    
        return redirect('/salary');
    }
}
