<?php

use App\Http\Controllers\PraticienController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\VisiteurController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return view('home');
});

Route::get('/getLogin', [VisiteurController::class, 'getLogin']);
Route::post('/login', [VisiteurController::class, 'signIn'])->middleware('cors');
Route::get('/getLogout', [VisiteurController::class, 'signOut']);

Route::get('/listePraticiens', [PraticienController::class, 'getListePraticiens']);

Route::get('/specialitesPraticien/{id}', [SpecialiteController::class, 'getListeSpecialitesParPraticien'])->middleware('cors');

Route::get('/specialitesNonAffectees', [SpecialiteController::class, 'getSpecialitesNonAffectees']);

Route::post('/deleteSpecialite', [SpecialiteController::class, 'postDeleteSpecialite'])->middleware('cors');

Route::post('/addSpecialite', [SpecialiteController::class, 'postAddSpecialite'])->middleware('cors');

Route::get('/updateSpecialite/{id}', [SpecialiteController::class, 'getUpdateSpecialite']);

Route::post('/updateSpecialite', [SpecialiteController::class, 'postUpdateSpecialite'])->middleware('cors');

Route::post('/postSearch',
    [
        'as' => 'postSearch',
        'uses' => 'App\Http\Controllers\PraticienController@postSearch'
    ])->middleware('cors');
