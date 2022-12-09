<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;


Auth::routes();

Route::get('/', [AdController::class, 'index'])->name('welcome');

//SINGLE AD ROUTES
Route::get('/single-ad/{id}', [AdController::class, 'showAd'])->name('singleAd');
Route::post('/single-ad/{id}/send-message', [AdController::class, 'sendMessage'])->name('sendMessage');

//HOME ROUTES VEZANE ZA KORISNIKA
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'addDeposit'])->middleware('auth')->name('home.addDeposit');
Route::get('/home/ad-form', [App\Http\Controllers\HomeController::class, 'adForm'])->middleware('auth')->name('home.adForm');
Route::get('/home/ad/{id}', [App\Http\Controllers\HomeController::class, 'showSingleAd'])->middleware('auth')->name('home.singleAd');
Route::get('/home/messages', [App\Http\Controllers\HomeController::class, 'showMessages'])->middleware('auth')->name('home.showMessages');
Route::get('/home/messages/reply', [App\Http\Controllers\HomeController::class, 'reply'])->middleware('auth')->name('home.reply');

Route::post('/home/messages/reply', [App\Http\Controllers\HomeController::class, 'replyStore'])->middleware('auth')->name('home.replyStore');
Route::post('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'updateDeposit'])->middleware('auth')->name('home.addDeposit');
Route::post('/home/save-ad', [App\Http\Controllers\HomeController::class, 'saveAd'])->middleware('auth')->name('home.saveAd');

