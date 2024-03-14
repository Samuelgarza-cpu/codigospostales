<?php

use App\Http\Controllers\PagosEnLinea\PagoEnLineaController;
use Illuminate\Support\Facades\Route;

Route::get("/", [PagoEnLineaController::class, function () {
    return 'API PAGOS EN LINEA';
}]);
Route::post('/PMS_CVECAT', [PagoEnLineaController::class, 'getPMS_CVECATWhCveCat']);

Route::post('/PREDIAL', [PagoEnLineaController::class, 'GetPREDIALWhCveCat']);

Route::post('/SPCalculo3', [PagoEnLineaController::class, 'spPredial_Calculo3']);

Route::post('/SPEdoCta', [PagoEnLineaController::class, 'spPredial_EdoCta']);

Route::post('/GuardaInfConsultaInternet', [PagoEnLineaController::class, 'spPredial_GuardaInfConsultaInternet']);

Route::post('/PagoPredial', [PagoEnLineaController::class, 'GetPredPagWhCveCatDate']);

Route::post('/PagoEnLinea', [PagoEnLineaController::class, 'GetPagoEnLineaCveCatTrans']);

Route::post('/PagoEnLineaFolio', [PagoEnLineaController::class, 'GetPagoEnLineaFolio']);

Route::post('/PredialAfiliacion', [PagoEnLineaController::class, 'GetPredialAfiliacionAfi']);

Route::post('/InsertPagoEnLinea', [PagoEnLineaController::class, 'insertPagosEnLinea']);

Route::post('/Impuestos', [PagoEnLineaController::class, 'GetImpuestosCveCat']);

Route::post('/EstadoDeCuenta', [PagoEnLineaController::class, 'GetPredEdCFolio']);

Route::post('/UpdateEstatEstadoDeCuenta', [PagoEnLineaController::class, 'UpdateEdoCuentaEstatus']);

Route::post('/PAGPREDIAL', [PagoEnLineaController::class, 'GetPAGPREDIALCveCat']);

// Route::post('/SpObtenFolioPagoe', [PagoEnLineaController::class, 'spObtenFolioPagoe']);


// Route::post('/get', [PagoEnLineaController::class, 'GetDataFacturacionPOST']);
// Route::get('/get', [PagoEnLineaController::class, 'ErrorReturn']);
// Route::post('/set', [PagoEnLineaController::class, 'SetDataFacturacionPOST']);
// Route::get('/set', [PagoEnLineaController::class, 'ErrorReturn']);
