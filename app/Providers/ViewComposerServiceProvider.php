<?php

namespace App\Providers;

use App\Models\model_pegawai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layout.sidebar', function ($view) {

            $dataUserLogin = model_pegawai::with('account')->where('kode_pegawai', Auth::user()->kode_pegawai)->get();

            $view->with('dataUserLogin', $dataUserLogin);
        });
    }
}
