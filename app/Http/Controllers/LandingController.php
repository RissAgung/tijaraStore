<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    function index()
    {

        $imgProduct = array(
            "wanita" => [
                "wanita1", "wanita2", "wanita3", "wanita4"
            ],
            "pria" => [
                "pria1", "pria2", "pria3", "pria4", "pria5"
            ],
            "anak" => [
                "anak1", "anak2", "anak3", "anak4"
            ]
        );

        // dd($imgProduct);

        return view('front_view.landing', compact('imgProduct'));
    }
}
