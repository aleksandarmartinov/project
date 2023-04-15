<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;


Auth::routes();

Route::get('/', [AdController::class, 'index'])->name('welcome');

//SINGLE AD ROUTES
Route::get('/single-ad/{id}', [AdController::class, 'show'])->name('singleAd');
Route::post('/single-ad/{id}', [AdController::class, 'like'])->name('like');
Route::post('/single-ad/{id}/send-message', [AdController::class, 'sendMessage'])->name('sendMessage');
Route::get('/search', [AdController::class, 'search'])->name('search');

//HOME ROUTES VEZANE ZA KORISNIKA
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home'); //user's dashboar view
Route::get('/home/ad/{id}', [App\Http\Controllers\HomeController::class, 'showSingleAd'])->middleware('auth')->name('home.singleAd'); //view za single oglas usera
Route::get('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'addDeposit'])->name('home.addDeposit'); //view za add deposit
Route::post('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'updateDeposit'])->middleware('auth')->name('home.addDeposit'); //dodavanje deposita
Route::get('/home/ad-form', [App\Http\Controllers\HomeController::class, 'adForm'])->middleware('auth')->name('home.adForm'); //view za dodavanje oglasa
Route::post('/home/save-ad', [App\Http\Controllers\HomeController::class, 'saveAd'])->middleware('auth')->name('home.saveAd'); //save oglas
Route::get('/home/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->middleware('auth')->name('home.edit'); //view za edit
Route::put('/home/edit/{id}', [App\Http\Controllers\HomeController::class, 'updateAd'])->middleware('auth')->name('home.updateAd'); //update oglas
Route::delete('/home/delete/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->middleware('auth')->name('adDelete'); //delete


Route::get('/home/messages', [App\Http\Controllers\HomeController::class, 'showMessages'])->middleware('auth')->name('home.showMessages');
Route::get('/home/messages/reply', [App\Http\Controllers\HomeController::class, 'reply'])->middleware('auth')->name('home.reply');
Route::post('/home/messages/reply', [App\Http\Controllers\HomeController::class, 'replyStore'])->middleware('auth')->name('home.replyStore');







