<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\pengeluaran\pengeluaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */

  protected $table = 'ACCOUNT'; // mendevinisikan nama table
  protected $primaryKey = 'kode_account'; // mendevinisikan primary key
  public $incrementing = false; // auto pada primaryKey incremment false
  public $timestamps = false; // create_at dan update_at false

  // fillable mendevinisikan field mana saja yang dapat kita isikan
  protected $fillable = [
    'kode_account',
    'username',
    'password',
    'level',
  ];

  public function pegawai(){
    return $this->hasOne(model_pegawai::class, 'kode_account', 'kode_account');
  }

  // public function pengeluaran(){
  //   return $this->hasMany(pengeluaran::class, 'kode_account', 'kode_account');
  // }

  // private function allData()
  // {
  //   return collect($this->all());
  // }

  // public function autoID()
  // {
  //   return $this->allData()->last()->kode_account + 1;
  // }

  // public function cekLevel($username){
  //   $level = $this->allData()->where('username', $username)->pluck('level');

  //   return $level[0] === "superadmin" ? true : false;
  // }

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];
}
