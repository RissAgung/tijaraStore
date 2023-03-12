<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/", function(){
  return view("layout.main");
});

Route::get("/product", function(){
  return view("master.data_product");
});

Route::post('/product/add', function (Request $request) {
    dd($request);
});;
