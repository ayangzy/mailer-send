<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EmailController;

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


Route::prefix('v1')->group(function(){
    Route::prefix('emails')->name('email.')->group(function(){
        Route::post('send', [EmailController::class, 'store'])->name('store');
        Route::get('/', [EmailController::class, 'index'])->name('index');
        Route::get('/{id}', [EmailController::class, 'show'])->name('show');
        Route::get('/{id}/recipients', [EmailController::class, 'recipient'])->name('recipient');
    });

    Route::get('/search/email', [EmailController::class, 'searchEmail'])->name('searchEmail');
});