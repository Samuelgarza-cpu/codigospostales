<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

#region CONTROLLERS BECAS
use App\Http\Controllers\Becas\RoleBecasController;
use App\Http\Controllers\Becas\UserBecasController;
use App\Http\Controllers\Becas\PerimeterBecasController;
use App\Http\Controllers\Becas\CityBecasController;
use App\Http\Controllers\Becas\ColonyBecasController;
use App\Http\Controllers\Becas\DisabilityBecasController;
use App\Http\Controllers\Becas\LevelBecasController;
use App\Http\Controllers\Becas\SchoolBecasController;
use App\Http\Controllers\Becas\Beca1StudentDataController;
use App\Http\Controllers\Becas\BecaController;
use App\Http\Controllers\Becas\RelationshipController;
use App\Models\becas\Beca1TutorData;

#endregion CONTROLLERS BECAS

Route::post('/login', [UserBecasController::class, 'login']);
Route::post('/signup', [UserBecasController::class, 'signup']);

// Route::middleware('auth:sanctum')->group(function () {
// Route::get('/getUser/{token}', [UserBecasController::class,'getUser']); //cerrar sesión (eliminar los tokens creados)
Route::delete('/logout/{id}', [UserBecasController::class, 'logout']); //cerrar sesión (eliminar los tokens creados)

Route::controller(UserBecasController::class)->group(function () {
   Route::get('/users', 'index');
   Route::get('/users/selectIndex', 'selectIndex');
   Route::get('/users/{id}', 'show');
   Route::post('/users', 'create');
   Route::put('/users/{id?}', 'update');
   Route::delete('/users/{id}', 'destroy');
});

Route::controller(RoleBecasController::class)->group(function () {
   Route::get('/roles', 'index');
   Route::get('/roles/selectIndex', 'selectIndex');
   Route::get('/roles/{id}', 'show');
   Route::post('/roles', 'create');
   Route::put('/roles/{id?}', 'update');
   Route::delete('/roles/{id}', 'destroy');
});

Route::controller(PerimeterBecasController::class)->group(function () {
   Route::get('/perimeters', 'index');
   Route::get('/perimeters/selectIndex', 'selectIndex');
   Route::get('/perimeters/{id}', 'show');
   Route::post('/perimeters', 'create');
   Route::put('/perimeters/{id?}', 'update');
   Route::delete('/perimeters/{id}', 'destroy');
});

Route::controller(LevelBecasController::class)->group(function () {
   Route::get('/levels', 'index');
   Route::get('/levels/selectIndex', 'selectIndex');
   Route::get('/levels/{id}', 'show');
   Route::post('/levels', 'create');
   Route::put('/levels/{id}', 'update');
   Route::put('/levels', 'update');
   Route::delete('/levels/{id}', 'destroy');
});

Route::controller(SchoolBecasController::class)->group(function () {
   Route::get('/schools', 'index');
   Route::get('/schools/selectIndex', 'selectIndex');
   Route::get('/schools/{id}', 'show');
   Route::post('/schools', 'create');
   Route::put('/schools/{id?}', 'update');
   Route::delete('/schools/{id}', 'destroy');
});

Route::controller(DisabilityBecasController::class)->group(function () {
   Route::get('/disabilities', 'index');
   Route::get('/disabilities/selectIndex', 'selectIndex');
   Route::get('/disabilities/{id}', 'show');
   Route::post('/disabilities', 'create');
   Route::put('/disabilities/{id?}', 'update');
   Route::delete('/disabilities/{id}', 'destroy');
});

Route::controller(RelationshipController::class)->group(function () {
   Route::get('/relationships', 'index');
   Route::get('/relationships/selectIndex', 'selectIndex');
   Route::get('/relationships/{id}', 'show');
   Route::post('/relationships', 'create');
   Route::put('/relationships/{id?}', 'update');
   Route::delete('/relationships/{id}', 'destroy');
});

Route::controller(Beca1TutorData::class)->group(function () {
   Route::get('/tutors', 'index');
   Route::get('/tutors/selectIndex', 'selectIndex');
   Route::get('/tutors/{id}', 'show');
   Route::get('/tutors/curp/{curp}', 'show');
   Route::post('/tutors', 'create');
   Route::put('/tutors/{id?}', 'update');
   Route::delete('/tutors/{id}', 'destroy');
});

Route::controller(Beca1StudentDataController::class)->group(function () {
   Route::get('/students', 'index');
   Route::get('/students/selectIndex', 'selectIndex');
   Route::get('/students/{id}', 'show');
   Route::get('/students/curp/{curp}', 'show');
   Route::post('/students', 'create');
   Route::put('/students/{id?}', 'update');
   Route::delete('/students/{id}', 'destroy');
});

Route::controller(BecaController::class)->group(function () {
   Route::get('/becas', 'index');
   Route::get('/becas/selectIndex', 'selectIndex');
   Route::get('/becas/id/{id}', 'show');
   Route::post('/becas', 'create');
   Route::put('/becas/{id?}', 'update');
   Route::delete('/becas/{id}', 'destroy');

   Route::get('/becas/getLastFolio', 'getLastFolio');
});
// });