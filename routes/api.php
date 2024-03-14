<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RequisicionController;
use App\Http\Controllers\oficiosController;
use App\Http\Controllers\CodigoPostalController;

use App\Http\Controllers\EstadosController;



#region CONTROLLERS INGRESOS
use App\Http\Controllers\Ingresos\SiditController;
use App\Http\Controllers\websockets\Websocketglobal;
#endregion CONTROLLERS INGRESOS


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::api('usuario',[UsuarioController::class,'index']);

Route::apiResource('usuario', UsuarioController::class);
Route::apiResource('requis', RequisicionController::class);
Route::post('pdf', [oficiosController::class, 'pdf']);
Route::get('pdf', function () {
    return 1;
});
Route::get('test', [Websocketglobal::class, 'socketGlobal']);

Route::get('cp/{id}', [CodigoPostalController::class, 'index']);
Route::get('cp/colonia/{id}', [CodigoPostalController::class, 'colonia']);


Route::get('estados', [EstadosController::class, 'index']);
Route::get('estados/{id}', [EstadosController::class, 'estadosFind']);

Route::get('comunidades', [CodigoPostalController::class, 'indexCommunities']);
Route::get('comunidades/municipio/{municipio_id}', [CodigoPostalController::class, 'indexCommunities']);
Route::get('comunidades/id/{id}', [CodigoPostalController::class, 'showCommunity']);
Route::get('colonias/perimetro/{perimeter_id}', [CodigoPostalController::class, 'coloniesByPerimeter']);
Route::get('comunidades/perimetro/{perimeter_id}', [CodigoPostalController::class, 'communitiesByPerimeter']);
Route::get('perimetros/id/{id?}', [CodigoPostalController::class, 'perimeters']);
Route::get('perimetros/{perimeter_id}/assignToCommunity/{community_id}', [CodigoPostalController::class, 'assignPerimeterToCommunity']);
Route::get('perimetros/selectIndex', [CodigoPostalController::class, 'selectIndexPerimeters']);
Route::post('perimetros/create', [CodigoPostalController::class, 'createOrUpdatePerimeter']);
Route::post('perimetros/update/{id}', [CodigoPostalController::class, 'createOrUpdatePerimeter']);




Route::prefix('becas')->group(function () {
    Route::get('/', function () {
        return 'becas';
    });
    include_once "becas.routes.php";
});

Route::prefix('sidit/tramites')->group(function () {
    Route::get("/", function () {
        return "sidit ONLINE";
    });
    Route::post('/', [SiditController::class, 'create']);
});

Route::prefix('gpCenter')->group(function () {
    Route::get('/', function () {
        return 'API GPCenter';
    });
    include_once "gpcenter.routes.php";
});

Route::prefix('gomezapp')->group(function () {
    Route::get('/', function () {
        return 'API GomezApp';
    });
    include_once "gomezapp.routes.php";
});


Route::prefix('imm')->group(function () {
    include_once "imm.routes.php";
});

Route::prefix('facturacion')->group(function () {
    include_once("facturacion.routes.php");
});

Route::prefix('PagoEnLinea')->group(function () {
    include_once("pagoenlinea.routes.php");
});
