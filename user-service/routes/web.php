<?php

use Illuminate\Support\Facades\Route;

if (file_exists(base_path('routes/api.php'))) {
    require base_path('routes/api.php');
}

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});
