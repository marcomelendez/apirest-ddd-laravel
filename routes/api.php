<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeadController;
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

Route::post('/auth', [AuthController::class,'login'])->name('login');
Route::post('/register', [AuthController::class,'register']);

Route::group(['middleware' => 'jwt'], function () {
    Route::controller(LeadController::class)->group(function(){
        Route::get('/lead/{id}','show')->name('lead.show');
        Route::get('/leads','index')->name('lead.index');
        Route::post('/lead','store')->name('lead.lead');
    });
});

