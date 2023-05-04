<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\PraticienController;
use App\Http\Controllers\SpecialiteController;


Route::get('/', function () {
    return view('home');
});

Route::get('/getLogin', [VisiteurController::class, 'getLogin']);
Route::post('/login', [VisiteurController::class, 'signIn']);
Route::get('/getLogout', [VisiteurController::class, 'signOut']);

Route::get('/listePraticiens', [PraticienController::class, 'getListePraticiens']);

Route::get('/specialitesPraticien/{id}', [SpecialiteController::class, 'getListeSpecialitesParPraticien']);

Route::get('/deleteSpecialite/{id}', [SpecialiteController::class, 'getDeleteSpecialite']);

Route::post('/addSpecialite', [SpecialiteController::class, 'postAddSpecialite']);

Route::get('/updateSpecialite/{id}', [SpecialiteController::class, 'getUpdateSpecialite']);

Route::post('/updateSpecialite', [SpecialiteController::class, 'postUpdateSpecialite']);

Route::post('/postSearch',
    [
        'as' => 'postSearch',
        'uses' => 'App\Http\Controllers\PraticienController@postSearch'
    ]);
