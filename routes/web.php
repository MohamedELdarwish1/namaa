<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();



Route::group(['middleware' => ['auth']], function () {

    Route::get('/', [App\Http\Controllers\ArticlesController::class, 'index'])->name('articles.index');

    Route::resource('/articles', \App\Http\Controllers\ArticlesController::class);
    Route::get('/approve/{article_id}', [App\Http\Controllers\ArticlesController::class, 'Approve'])->name('approve');
    Route::resource('/comments', \App\Http\Controllers\CommentsController::class);

    Route::get('/live-search',[App\Http\Controllers\SearchController::class, 'liveSearch'] )->name('live-search');


});
