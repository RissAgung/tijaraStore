<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
  // redirect ke halaman login
  public function index()
  {
    return view('front_view.login');
    // dd(Hash::make('123'));
    // dd(User::all());
  }

  // check login
  public function checkLogin(Request $request)
  {

    // validasi inputan dari request, disini kita menggunakan validasi required / wajib di isi
    $dataLogin = $request->validate([
      'username' => 'required',
      'password' => 'required'
    ]);

    // jalankan fungsi attempt dengan parameter $dataLogin yang telah di validasi, yang mana Auth::attempt defauld nya melakukan pengecekan usernam dan password dengan format enkripsi bawaan laravel
    if (Auth::attempt($dataLogin)) {

      // cek apakah atribut level pada data yang di inputkan sama dengan 'superadmin'
      // jika iya maka regenerate session dan return ke dashboard atau halaman yang di inginkan
      if (Auth::user()->level === 'superadmin' || Auth::user()->level === 'admin') {

        $request->session()->regenerate();

        // Tampilkan SweetAlert
        // https://github.com/realrashid/sweet-alert
        toast('Berhasil Login', 'success')->position('top')->autoClose(3000);

        return redirect()->intended('/retur');
      } else {

        // apabila level bukan superadmin maka akan menjalankan fungsi logout, session di invalidasi, dan token akan di buat ulang
        // dan return back() atau kembali pada halaman sebelumnya dengan mengembalikan nilai lama pada inputan dengan menambahkan fungsi withInput()
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Tampilkan SweetAlert
        // https://github.com/realrashid/sweet-alert
        toast('Login Gagal', 'error')->position('top')->autoClose(3000);

        return back()->withInput();
      }
    } else {

      // jika auth gagal return back() atau kembali pada halaman sebelumnya dengan mengembalikan nilai lama pada inputan dengan menambahkan fungsi withInput()

      // Tampilkan SweetAlert
      // https://github.com/realrashid/sweet-alert
      toast('Login Gagal', 'error')->position('top')->autoClose(3000);

      return back()->withInput();
    }
  }

  // coba register
  // public function registerhahai(Request $request)
  // {

  //   $dataRegister = $request->validate([
  //     'username' => 'required',
  //     'password' => 'required'
  //   ]);

  //   // User dari Model User
  //   $users = new User();

  //   $user = new User([
  //     'kode_account' => $users->autoID(),
  //     'username' => $request->username,
  //     'password' => Hash::make($request->password),
  //     'level' => 'admin'
  //   ]);

  //   $user->save();

  //   return redirect()->route('login');
  // }

  // logout
  public function logout(Request $request)
  {

    // menjalankan fungsi logout, session di invalidasi, dan token akan di buat ulang
    // dan return menuju halaman login

    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
  }
}
