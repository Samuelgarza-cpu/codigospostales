<?php

use App\Http\Controllers\Facturaciones\FactuacionController;
use Illuminate\Support\Facades\Route;

Route::get("/",[FactuacionController::class, 'index']);
Route::get('/index', [FactuacionController::class, 'index']);
Route::post('/get', [FactuacionController::class, 'GetDataFacturacionPOST']);
Route::get('/get', [FactuacionController::class, 'ErrorReturn']);
Route::post('/set', [FactuacionController::class, 'SetDataFacturacionPOST']);
Route::get('/set', [FactuacionController::class, 'ErrorReturn']);
?>