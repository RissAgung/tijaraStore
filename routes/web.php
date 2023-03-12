<?php

use Illuminate\Support\Facades\Route;

Route::get("/", function(){
  return view("layout.main");
});

Route::get("/product", function(){
  return view("master.data_product");
});
