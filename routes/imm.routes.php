<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\imm\GenderImmController;
use App\Http\Controllers\imm\CivilStatusImmController;
use App\Http\Controllers\imm\ColoniesImmController;
use App\Http\Controllers\imm\MunicipalitiesImmController;
use App\Http\Controllers\imm\StateImmController;
use App\Http\Controllers\imm\ActivitiesImmController;
use App\Http\Controllers\imm\DiseasesImmController;
use App\Http\Controllers\imm\WorkplaceImmController;
use App\Http\Controllers\imm\MedicalServicesImmController;
use App\Http\Controllers\imm\TrainingController;
use App\Http\Controllers\imm\OriginsImmController;
use App\Http\Controllers\imm\DiasesOriginsDiasesImmController;
use App\Http\Controllers\imm\DisabilitiesImmController;
use App\Http\Controllers\imm\DisabilitiesOriginDisabilitiesController;
use App\Http\Controllers\imm\DisabilityOriginImmController;
use App\Http\Controllers\imm\HouseholdsImmController;
use App\Http\Controllers\imm\AddictionsImmController;
use App\Http\Controllers\imm\AxisImmController;
use App\Http\Controllers\imm\AxisProgramImmController;
use App\Http\Controllers\imm\ClosuremotifImmController;
use App\Http\Controllers\imm\FieldViolenceImmController;
use App\Http\Controllers\imm\LowEffectImmController;
use App\Http\Controllers\imm\ProblematicImmController;
use App\Http\Controllers\imm\ServicesImmController;
use App\Http\Controllers\imm\StatusImmController;
use App\Http\Controllers\imm\TypeViolenceImmController;
use App\Http\Controllers\imm\UserImmController;
use App\Http\Controllers\imm\UserProceedingsImmController;
use App\Http\Controllers\imm\UserProfileImmController;
use App\Http\Controllers\imm\UserFilesImmController;
use App\Http\Controllers\imm\CaptureImmActivitiesController;
use App\Http\Controllers\imm\ExpendentImmController;
//SE USA
Route::controller(GenderImmController::class)->group(function () {
    Route::get('/genders','index');
    Route::get('/genders/selectIndex','selectIndex');
    Route::get('/genders/{id}','show');
    Route::post('/genders','create');
    Route::put('/genders','update');
    Route::delete('/genders/{id}','destroy');
});
//SE USA
Route::controller(CivilStatusImmController::class)->group(function () {
    Route::get('/civilstatus','index');
    Route::get('/civilstatus/selectIndex','selectIndex');
    Route::get('/civilstatus/{id}','show');
    Route::post('/civilstatus','create');
    Route::put('/civilstatus','update');
    Route::delete('/civilstatus/{id}','destroy');
});
//SE USA 
Route::controller(ActivitiesImmController::class)->group(function () {
    Route::get('/activity','index');
    Route::get('/activity/selectIndex','selectIndex');
    Route::get('/activity/{id}','show');
    Route::post('/activity','create');
    Route::put('/activity','update');
    Route::delete('/activity/{id}','destroy');
});
//SE USA 
Route::controller(WorkplaceImmController::class)->group(function () {
    Route::get('/workplace','index');
    Route::get('/workplace/selectIndex','selectIndex');
    Route::get('/workplace/{id}','show');
    Route::post('/workplace','create');
    Route::put('/workplace','update');
    Route::delete('/workplace/{id}','destroy');
});
//SE USA 
Route::controller(MedicalServicesImmController::class)->group(function () {
    Route::get('/medicalservice','index');
    Route::get('/medicalservice/selectIndex','selectIndex');
    Route::get('/medicalservice/{id}','show');
    Route::post('/medicalservice','create');
    Route::put('/medicalservice','update');
    Route::delete('/medicalservice/{id}','destroy');
});
//Formacion educativa
Route::controller(TrainingController::class)->group(function () {
    Route::get('/training','index');
    Route::get('/training/selectIndex','selectIndex');
    Route::get('/training/{id}','show');
    Route::post('/training','create');
    Route::put('/training','update');
    Route::delete('/training/{id}','destroy');
});
//ENFERMEDADES
Route::controller(DiseasesImmController::class)->group(function () {
    Route::get('/diseas','index');
    Route::get('/diseas/selectIndex','selectIndex');
    Route::get('/diseas/{id}','show');
    Route::post('/diseas','create');
    Route::put('/diseas','update');
    Route::delete('/diseas/{id}','destroy');
});
Route::controller(OriginsImmController::class)->group(function () {
    Route::get('/origin','index');
    Route::get('/origin/selectIndex','selectIndex');
    Route::get('/origin/{id}','show');
    Route::post('/origin','create');
    Route::put('/origin','update');
    Route::delete('/origin/{id}','destroy');
});

Route::controller(DisabilitiesImmController::class)->group(function () {
    Route::get('/disabilities','index');
    Route::get('/disabilities/selectIndex','selectIndex');
    Route::get('/disabilities/{id}','show');
    Route::post('/disabilities','create');
    Route::put('/disabilities','update');
    Route::delete('/disabilities/{id}','destroy');
});







Route::controller(StateImmController::class)->group(function () {
    Route::get('/states','index');
    Route::get('/states/selectIndex','selectIndex');
    Route::get('/states/{id}','show');
    Route::post('/states','create');
    Route::put('/states','update');
    Route::delete('/states/{id}','destroy');
});
Route::controller(MunicipalitiesImmController::class)->group(function () {
    Route::get('/municipality','index');
    Route::get('/municipality/selectIndex','selectIndex');
    Route::get('/municipality/{id}','show');
    Route::post('/municipality','create');
    Route::put('/municipality','update');
    Route::delete('/municipality/{id}','destroy');
});
Route::controller(ColoniesImmController::class)->group(function () {
    Route::get('/colony','index');
    Route::get('/colony/selectIndex','selectIndex');
    Route::get('/colony/{id}','show');
    Route::post('/colony','create');
    Route::put('/colony','update');
    Route::delete('/colony/{id}','destroy');
});
//


Route::controller(DiasesOriginsDiasesImmController::class)->group(function () {
    Route::get('/diasesorigindiases','index');
    Route::get('/diasesorigindiases/selectIndex','selectIndex');
    Route::get('/diasesorigindiases/{id}','show');
    Route::post('/diasesorigindiases','create');
    Route::put('/diasesorigindiases','update');
    Route::delete('/diasesorigindiases/{id}','destroy');
});

Route::controller(DisabilityOriginImmController::class)->group(function () {
    Route::get('/disabilityorigins','index');
    Route::get('/disabilityorigins/selectIndex','selectIndex');
    Route::get('/disabilityorigins/{id}','show');
    Route::post('/disabilityorigins','create');
    Route::put('/disabilityorigins','update');
    Route::delete('/disabilityorigins/{id}','destroy');
});
Route::controller(DisabilitiesOriginDisabilitiesController::class)->group(function () {
    Route::get('/disabilitiesorigindisabilities','index');
    Route::get('/disabilitiesorigindisabilities/selectIndex','selectIndex');
    Route::get('/disabilitiesorigindisabilities/{id}','show');
    Route::post('/disabilitiesorigindisabilities','create');
    Route::put('/disabilitiesorigindisabilities','update');
    Route::delete('/disabilitiesorigindisabilities/{id}','destroy');
});

Route::controller(HouseholdsImmController::class)->group(function () {
    Route::get('/households','index');
    Route::get('/households/selectIndex','selectIndex');
    Route::get('/households/{id}','show');
    Route::post('/households','create');
    Route::put('/households','update');
    Route::delete('/households/{id}','destroy');
});
Route::controller(AddictionsImmController::class)->group(function () {
    Route::get('/addictions','index');
    Route::get('/addictions/selectIndex','selectIndex');
    Route::get('/addictions/{id}','show');
    Route::post('/addictions','create');
    Route::put('/addictions','update');
    Route::delete('/addictions/{id}','destroy');
});
Route::controller(TypeViolenceImmController::class)->group(function () {
    Route::get('/typesviolences','index');
    Route::get('/typesviolences/selectIndex','selectIndex');
    Route::get('/typesviolences/{id}','show');
    Route::post('/typesviolences','create');
    Route::put('/typesviolences','update');
    Route::delete('/typesviolences/{id}','destroy');
});
Route::controller(FieldViolenceImmController::class)->group(function () {
    Route::get('/fieldviolence','index');
    Route::get('/fieldviolence/selectIndex','selectIndex');
    Route::get('/fieldviolence/{id}','show');
    Route::post('/fieldviolence','create');
    Route::put('/fieldviolence','update');
    Route::delete('/fieldviolence/{id}','destroy');
});
Route::controller(LowEffectImmController::class)->group(function () {
    Route::get('/loweffects','index');
    Route::get('/loweffects/selectIndex','selectIndex');
    Route::get('/loweffects/{id}','show');
    Route::post('/loweffects','create');
    Route::put('/loweffects','update');
    Route::delete('/loweffects/{id}','destroy');
});
Route::controller(ServicesImmController::class)->group(function () {
    Route::get('/services','index');
    Route::get('/services/selectIndex','selectIndex');
    Route::get('/services/{id}','show');
    Route::post('/services','create');
    Route::put('/services','update');
    Route::delete('/services/{id}','destroy');
});

Route::controller(AxisImmController::class)->group(function () {
    Route::get('/axis','index');
    Route::get('/axis/selectIndex','selectIndex');
    Route::get('/axis/{id}','show');
    Route::post('/axis','create');
    Route::put('/axis','update');
    Route::delete('/axis/{id}','destroy');
});
Route::controller(AxisProgramImmController::class)->group(function () {
    Route::get('/axisprogram/types/{id}','axisProgram');
    Route::get('/axisprogram','index');
    Route::get('/axisprogram/selectIndex','selectIndex');
    Route::get('/axisprogram/{id}','show');
    Route::post('/axisprogram','create');
    Route::put('/axisprogram','update');
    Route::delete('/axisprogram/{id}','destroy');
});
Route::controller(StatusImmController::class)->group(function () {
    Route::get('/status','index');
    Route::get('/status/selectIndex','selectIndex');
    Route::get('/status/{id}','show');
    Route::post('/status','create');
    Route::put('/status','update');
    Route::delete('/status/{id}','destroy');
});
Route::controller(ProblematicImmController::class)->group(function () {
    Route::get('/problem','index');
    Route::get('/problem/selectIndex','selectIndex');
    Route::get('/problem/{id}','show');
    Route::post('/problem','create');
    Route::put('/problem','update');
    Route::delete('/problem/{id}','destroy');
});
Route::controller(ClosuremotifImmController::class)->group(function () {
    Route::get('/motive','index');
    Route::get('/motive/selectIndex','selectIndex');
    Route::get('/motive/{id}','show');
    Route::post('/motive','create');
    Route::put('/motive','update');
    Route::delete('/motive/{id}','destroy');
});

Route::controller(UserProfileImmController::class)->group(function () {
    Route::get('/updatestatus/{iduser}/{idstatus}','statusServiceProfile');
    Route::post('/userdatageneral/{id?}','createData');
    Route::post('/userprofile/{id}','createProfile');
    Route::post('/userviolence/{id}','createViolence');
    Route::post('/profileagressor/{id}','profileAgressor');
    Route::post('/userservice/{id}','createService');
    Route::get('/users','index');
    Route::get('/usersmodule2','allUsersModule2');
    Route::delete('/users/{id}','destroy');
    Route::get('/userdatageneral/{id}','getData');
    Route::get('/userprofile/{id}','getProfile');
    Route::get('/userviolence/{id}','getViolence');
    Route::get('/profileagressor/{id}','getprofileAgressor');
    Route::get('/userservice/{id}','getServices');
    Route::get('/usereport/{id}','getUserAllData');
    Route::get('/usereport2/{id}','getUserData');
    Route::get('/users2','usersM4Module1');
    Route::get('/userworkshop/{id}','getDataModule2');
    Route::get('/usereportmodule2/{id}','getUserAllDataModule2');
    
    
    
});
Route::controller(UserProceedingsImmController::class)->group(function () {
    Route::get('/proceding','index');

});
Route::controller(UserFilesImmController::class)->group(function () {
    Route::post('/userfiles','create');
    Route::get('/userfiles/{id}','index');

});
Route::controller(CaptureImmActivitiesController::class)->group(function () {
    Route::get('/captureactivities','index');
    Route::get('/activitiesdata/{id}','getDataModule3');
    Route::get('/captureactivities/{id}','show');
    Route::post('/captureactivities','create');
    Route::post('/captureactivities/{id}','update');
     Route::delete('/captureactivities/{id}','destroy');

});
Route::controller(ExpendentImmController::class)->group(function () {
    Route::post('/expendent','create');
    Route::get('/expedentproblem','selectIndexProblem');
    Route::get('/expendentclose','selectIndexMotiveClosed');
    Route::get('/expendentviolence','selectIndexTypeViolece');
    Route::get('/expendents','index');
    Route::get('/expendent/{id}','show');
    Route::get('/expendentpdf/{id}','pdf');
    Route::post('/expendentupdate/{id}','update');
    Route::delete('/expendent/{id}','destroy');

});


Route::post('/auth/login', [UserImmController::class, 'login']);
Route::post('/auth/register', [UserImmController::class, 'register']);
Route::delete('/auth/logout/{id}', [UserImmController::class,'logout']); //cerrar sesión (eliminar los tokens creados)
Route::get('/auth/emails', [UserImmController::class, 'emails']);



Route::middleware('auth:bd_imm')->get('/user', function (Request $request) {
    
    return 'Texto de ejemplo'; // Puedes reemplazar 'Texto de ejemplo' con el texto que desees mostrar.
});

