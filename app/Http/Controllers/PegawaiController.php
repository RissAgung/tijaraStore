<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\model_pegawai as ModelsPegawai;
use App\Models\model_pegawai;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = ModelsPegawai::with('account')->paginate(4);
        // dd($pegawai);

        // $pegawai = ModelsPegawai::paginate(5);
        return view('pegawai.data_pegawai', compact('pegawai'));
    }

    public function store(Request $request)
    {
        $role = $request->role;
        $request->validate([
            'no_hp' => 'required|max:14',
        ]);

        // $employeeeid = 'PG'.str_pad(DB::table('pegawai')->count(), 4, '0', STR_PAD_LEFT).Carbon::now()->format('YmdHis');
        $employeeeid = 'PG' . str_pad(DB::table('pegawai')->count(), 3, '0', STR_PAD_LEFT) . Carbon::now()->format('YmdHis');
        // $idA = 'AC' . uniqid(4);
        // $idA = IdGenerator::generate(['table'=>'account','field'=>'kode_account','length'=>4, 'prefix'=>'AC']);
        // $idP = IdGenerator::generate(['table'=>'account','field'=>'kode_account','length'=>4, 'prefix'=>'PG']);
        if ($role == 'admin' || $role == 'kasir') {
            $pegawaiWA = new ModelsPegawai([
                'kode_pegawai' => $employeeeid,
                'nama' => $request->nama_pegawai,
                'gender' => $request->gender,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
            ]);
            $password = Hash::make($request->input('password'));
            $akun = new User([
                'kode_pegawai' => $employeeeid,
                'username' => $request->username,
                'password' => $password,
                'level' => $role,
            ]);
            try {
                $pegawaiWA->save();
                $akun->save();
                alert()
                    ->success('Berhasil', 'Data Pegawai Telah Di Tambahkan')
                    ->autoClose(3000);
                return redirect()->route('halaman_utama');
            } catch (\Throwable $th) {
                alert()
                    ->error('Gagal', 'Data Pegawai Gagal Di Simpan' . $th->getMessage())
                    ->autoClose(3000);
                return redirect()->route('halaman_utama');
            }
        } else {
            $pegawai = new ModelsPegawai([
                'kode_pegawai' => $employeeeid,
                'nama' => $request->nama_pegawai,
                'gender' => $request->gender,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
            ]);

            try {
                $pegawai->save();
                alert()
                    ->success('Berhasil', 'Data Pegawai Telah Di Tambahkan')
                    ->autoClose(3000);
                return redirect()->route('halaman_utama');
            } catch (\Throwable $th) {
                alert()
                    ->error('Gagal', 'Data Pegawai Gagal Di Simpan' . $th->getMessage())
                    ->autoClose(3000);
                return redirect()->route('halaman_utama');
            }
        }
    }

    public function delete($kodeP, $kodeA = null)
    {
        // Check apakah ada token

        // Check apakah token sesuai dengan token yang ada pada session ?

        // Jika sesuai maka akan proses dan generate ulang token
        // Jadi, tidak akan terjadi penggunaan token yang sama
        // Hal ini dilakukan untuk pencegahan untuk hal-hal yang tidak diinginkan
        // seperti memaksa menggunakan token yang telah dipakai sebelumnya untuk menghapus data yang lain

        $pegawai = ModelsPegawai::find($kodeP);
        if ($pegawai) {
            // Jika pegawai mempunyai account, maka hapus account terlebih dahulu
            if ($pegawai->account) {
                $pegawai->account()->delete();
            }
            // Hapus pegawai
            $pegawai->delete();
            try {
                alert()->success('Berhasil', 'Berhasil menghapus data pegawai');
                return redirect()->route('halaman_utama');
            } catch (\Throwable $th) {
                alert()
                    ->error('Gagal', 'Menghapus data pegawai' . $th->getMessage())
                    ->autoClose(3000);
                return redirect()->route('halaman_utama');
            }
        } else {
            alert()
                ->error('Gagal', 'Pegawai tidak ditemukan')
                ->autoClose(3000);
            return redirect()->route('halaman_utama');
        }
    }

    public function edit(Request $request)
    {
        // dd($kode);
        $pegawai1 = ModelsPegawai::find($request->kode_pegawai);
        // dd($request->kode_pegawai);
        $pegawai1->nama = $request->nama_pegawai;
        $pegawai1->gender = $request->gender;
        $pegawai1->alamat = $request->alamat;
        $pegawai1->no_hp = $request->no_hp;

        $pegawai1->save();

        alert()
            ->success('Berhasil', 'Berhasil Mengubah Data')
            ->showConfirmButton()
            ->focusConfirm(true);
        return redirect()
            ->back()
            ->with('success', 'Berhasil Mengubah Data');
    }

    public function delete_selected(Request $request)
    {
        foreach ($request->ids as $value) {
            $pegawai = ModelsPegawai::find($value);
            if ($pegawai->account) {
                $pegawai->account()->delete();
            }
            $pegawai->delete();
        }
        alert()->success('Berhasil', 'Berhasil Menghapus Data');
        return redirect()->route('halaman_utama');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        //dd($search);
        $pegawai = ModelsPegawai::where('nama', 'like', '%' . $search . '%')
            ->orWhere('kode_pegawai', 'like', '%' . $search . '%')
            ->get();
        return view('pegawai.data_pegawai', ['pegawai' => $pegawai]);
    }

    public function filter(Request $request)
    {
        $selectedGender = $request->segment(3);
        $pegawai = ModelsPegawai::with('account')
            ->join('account', 'pegawai.kode_pegawai', '=', 'account.kode_pegawai')
            ->where('pegawai.gender', '=', $selectedGender)
            ->paginate(5);

        return view('pegawai.data_pegawai', compact('pegawai'));
    }
    public function filterR(Request $request)
    {
        $selectedRole = $request->segment(3);

        if ($selectedRole === 'pegawai') {
            $pegawai = ModelsPegawai::leftJoin('account', 'account.kode_pegawai', '=', 'pegawai.kode_pegawai')
                ->select('pegawai.kode_pegawai', 'pegawai.nama', 'account.kode_pegawai', 'account.level')
                ->whereNull('account.level')
                ->paginate(5);
        } elseif ($selectedRole === 'admin') {
             $pegawai = ModelsPegawai::leftJoin('account', 'account.kode_pegawai', '=', 'pegawai.kode_pegawai')
                ->select('pegawai.kode_pegawai', 'pegawai.nama', 'account.kode_pegawai', 'account.level')
                ->where('account.level','=','admin')
                ->paginate(5);
        } else{
             $pegawai = ModelsPegawai::leftJoin('account', 'account.kode_pegawai', '=', 'pegawai.kode_pegawai')
                ->select('pegawai.kode_pegawai', 'pegawai.nama', 'account.kode_pegawai', 'account.level')
                ->where('account.level','=','kasir')
                ->paginate(5);
           
        }

        // $pegawai = ModelsPegawai::with('account')
        //     ->leftjoin('account', 'pegawai.kode_pegawai', '=', 'account.kode_pegawai')
        //     ->WhereNotNull('account.level')
        //     ->orwhereNull('account.level')
        //     ->paginate(5);

        return View('pegawai.data_pegawai', compact('pegawai'));
    }
}
