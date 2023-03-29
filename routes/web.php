<?php

use Illuminate\Support\Facades\Route;

Route::get("/", function () {
  return view("layout.main");
});

Route::get("/product", function () {
  return view("master.data_product");
});

Route::get("/login", function () {
  return view("front_view.login");
});

Route::prefix('laporan')->group(function () {
  Route::get("/pemasukan", function () {
    return view("report.pemasukan");
  });
  Route::get("/gatau", function () {
    return view("report.ppp");
  });
});
