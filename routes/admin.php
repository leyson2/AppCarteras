<?php

use Illuminate\Support\Facades\Route;


Route::get('/panel', function () {
    return view("home-admin");
});

Route::view('cliente', 'cliente');
Route::view('prestamo', 'prestamo');

