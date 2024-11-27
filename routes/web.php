<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tugas3_15225001_Marwan_Controller;

Route::get('/kendaraan', [Tugas3_15225001_Marwan_Controller::class, 'index']);
Route::get('/kendaraan/{no_plat}', [Tugas3_15225001_Marwan_Controller::class, 'show']);
