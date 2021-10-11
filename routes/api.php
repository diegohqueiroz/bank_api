<?php

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/tutorials','TutorialController@index');
Route::get('/tutorials/{id}','TutorialController@show');

Route::namespace('Api')->prefix('bank')->group(function () {
	Route::get('/accounts',							'BankAccountController@index');
	Route::get('/accounts/{id}',					'BankAccountController@show');
	Route::get('/accounts/{id}/balance',			'FinancialMovementController@balance');
	Route::put('/accounts/{id}/movement',			'FinancialMovementController@movement');
	Route::get('/accounts/{id}/statement',			'FinancialMovementController@statement');
});