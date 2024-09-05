<?php

use App\Http\Controllers\formateurscontroler;
use App\Http\Controllers\modulescontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post("register", [formateurscontroler::class, 'register']);
Route::post("login", [formateurscontroler::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){
 Route::get("profile", [formateurscontroler::class, 'profile'])->name('profile');
 Route::post("updateprofile/{id}", [formateurscontroler::class, 'updateprofile']);
 Route::post("logout", [formateurscontroler::class, 'logout']);

 //Modules manipulation
 Route::post("creermodule", [modulescontroller::class, 'creermodule']);
 Route::get("listemodule", [modulescontroller::class, 'listemodule']);
 Route::post("updatemodule/{id}", [modulescontroller::class, 'updatemodule']);
 Route::delete("deletemodule/{id}", [modulescontroller::class, 'deletemodule']);

 //Chapitres manipulation
 Route::post("creerchapter", [modulescontroller::class, 'creerchapter']);
 Route::get("listechapter/{idmodule}", [modulescontroller::class, 'listechapter']);
 Route::post("updatechapter/{id}", [modulescontroller::class, 'updatechapter']);
 Route::delete("deletechapter/{id}", [modulescontroller::class, 'deletechapter']);

 //Cours manipulation
 Route::post("creercours", [modulescontroller::class, 'creercours']);
 Route::get("listecours/{idchapter}", [modulescontroller::class, 'listecours']);
 Route::post("updatecours/{id}", [modulescontroller::class, 'updatecours']);
 Route::delete("deletecours/{id}", [modulescontroller::class, 'deletecours']);

 //QCM manipulation
 Route::post("creerqcm", [modulescontroller::class, 'creerqcm']);
 Route::get("listeqcm", [modulescontroller::class, 'listeqcm']);
 Route::post("updateqcm/{id}", [modulescontroller::class, 'updateqcm']);
 Route::delete("deleteqcm/{id}", [modulescontroller::class, 'deleteqcm']);
 
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
