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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'addDeposit'])->name('home.addDeposit');
Route::get('/home/ad-form', [App\Http\Controllers\HomeController::class, 'adForm'])->name('home.adForm');
Route::get('/home/ad/{id}', [App\Http\Controllers\HomeController::class, 'showSingleAd'])->name('home.singleAd');
Route::get('/home/messages', [App\Http\Controllers\HomeController::class, 'showMessages'])->name('home.showMessages');
Route::get('/home/messages/reply', [App\Http\Controllers\HomeController::class, 'reply'])->name('home.reply');

Route::post('/home/messages/reply', [App\Http\Controllers\HomeController::class, 'replyStore'])->name('home.replyStore');
Route::post('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'updateDeposit'])->name('home.addDeposit');
Route::post('/home/save-ad', [App\Http\Controllers\HomeController::class, 'saveAd'])->name('home.saveAd');

