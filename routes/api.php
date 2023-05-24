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

Route::group(array('namespace' => 'App\Http\Controllers\Api'), function () {

    /**
     * Bienvenida y datos iniciales
     */
    Route::get('welcome','ApiController@welcome');
    Route::get('getDataInit','ApiController@getDataInit');
    Route::get('GetSurveysAssign/{id}','ApiController@GetSurveysAssign');
    
    /**
     * Datos iniciales para usuarios registrados
     */ 
    Route::get('homepage_init/{city}','ApiController@homepage_init');

    /**
     * Funciones de registro
     */
    Route::post('signup','ApiController@signup');
    Route::post('signupOP','ApiController@signupOP');
    Route::post('sendOTP','ApiController@sendOTP');
    Route::post('SignPhone','ApiController@SignPhone');

    /**
     * Funciones de inicio de sesion y validacion de usuario
     */
    Route::post('login','ApiController@login');
    Route::post('chkUser','ApiController@chkUser');
    Route::post('Newlogin','ApiController@Newlogin'); 
    Route::post('loginFb','ApiController@loginFb');
    Route::get('userinfo/{id}','ApiController@userinfo');
    Route::post('updateInfo/{id}','ApiController@updateInfo');


    /**
     * 
     * Funciones para obtener usuario en especifico y conexiones
     * 
     */
    Route::get('getUser/{user}','ApiController@getUser');
    Route::post('createConn','ApiController@createConn');
    Route::get('getConnections/{id}','ApiController@getConnections');
    Route::get('search/{query}','ApiController@search');

    /**
     * 
     * Funciones para Generacion y manejo de QR
     * 
     */
    Route::get('getCatsQR','ApiController@getCatsQR');
    Route::get('getAllQR/{id}','ApiController@getAllQR');
    Route::get('getQRCode/{el}/{id}','ApiController@getQRCode');

    /**
     * 
     * Funciones para obtencion de Beacons
     * 
     */
    Route::get("getAllBeacons","ApiController@getAllBeacons");
    Route::get('BeaconPushNot/{beacon}/{id}','ApiController@beaconPushNot');
});
