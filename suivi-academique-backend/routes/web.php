<?php
use App\Http\Controllers\FiliereWebController;
use App\Http\Controllers\NiveauController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UEController;
use App\Http\Controllers\EcController;
use App\Http\Controllers\ProgrammationController;
use App\Http\Controllers\salleController;
use App\Http\Controllers\personnelController;


Route::get('/', function () {
    return view('welcome');
});

route:middleware('auth:sanctum')->group(function () {


Route::resource('filieres', FiliereWebController::class);
// Route::resource('Niveau', NiveauController::class);
 Route::resource("ue", UEController::class);

Route::apiResource("niveau",NiveauController::class);
Route::apiResource("ec",EcController::class);
Route::apiResource("programmation",ProgrammationController::class);
Route::apiResource("salle",salleController::class);
Route::apiResource("personnel",personnelController::class);
route::post('login', [App\Http\Controllers\AuthController::class, 'logout']);


});
route::post('/login',[AuthController::class,'login']);


