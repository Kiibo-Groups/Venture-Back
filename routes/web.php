<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::prefix(env('user'))->namespace('User')->group(static function() {
    Route::middleware('auth')->group(static function () {

        /*
        |-----------------------------------------
        |Dashboard and Account Setting & Logout
        |-----------------------------------------
        */ 
        Route::get('/',[App\Http\Controllers\Admin\AdminController::class, 'home'])->name('dash');
        Route::get('dash',[App\Http\Controllers\Admin\AdminController::class, 'home'])->name('dash');
        Route::get('settings',[App\Http\Controllers\Admin\AdminController::class, 'settings'])->name('settings'); 
        Route::post('/settings',[App\Http\Controllers\Admin\AdminController::class, 'settings_update']);
        Route::get('/profile',[App\Http\Controllers\Admin\AdminController::class, 'profile'])->name('profile'); 
        Route::post('/profile',[App\Http\Controllers\Admin\AdminController::class, 'update']);
        Route::get('logout',[App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('logoutAdmin');

        /*
        |-----------------------------------------
        |QR Generator
        |-----------------------------------------
        */ 
        Route::resource('qr_generator','\App\Http\Controllers\Admin\QRController');
        Route::get('/qr_generator',  [App\Http\Controllers\Admin\QRController::class, 'index'])->name('qr_generator');
        Route::get('/qr_generator/add',  [App\Http\Controllers\Admin\QRController::class, 'create'])->name('new_qr');
        Route::post('/qr_generator/store', [App\Http\Controllers\Admin\QRController::class, 'store'])->name('add_qr');
        Route::get('/qr_generator/list_qr', [App\Http\Controllers\Admin\QRController::class, 'list_qr'])->name('list_qr');
        Route::get('/qr_generator/delete/{id}',[App\Http\Controllers\Admin\QRController::class, 'destroy']);
        Route::get('/qr_generator/status/{id}',[App\Http\Controllers\Admin\QRController::class, 'status']);
        
        
        /*
        |-----------------------------------------
        |Reader QR Code
        |-----------------------------------------
        */ 
        Route::resource('qr_reader','\App\Http\Controllers\Admin\ReadQRController');
        Route::get('/qr_reader',  [App\Http\Controllers\Admin\ReadQRController::class, 'index'])->name('qr_reader');
        Route::post('/reader',  [App\Http\Controllers\Admin\ReadQRController::class, 'reader'])->name('reader');
        Route::get('/qr_reader/delete/{id}',[App\Http\Controllers\Admin\ReadQRController::class, 'destroy']);
        Route::get('/qr_reader/status/{id}',[App\Http\Controllers\Admin\ReadQRController::class, 'status']);
        
        

        /*
        |------------------------------
        |Manage Banner
        |------------------------------
        */
        Route::resource('banner','\App\Http\Controllers\Admin\BannerController');
        Route::get('banner',[App\Http\Controllers\Admin\BannerController::class, 'index'])->name('banners');
        Route::get('banner/delete/{id}',[App\Http\Controllers\Admin\BannerController::class, 'delete']);
        Route::get('banner/status/{id}',[App\Http\Controllers\Admin\BannerController::class, 'status']);

        /*
        |------------------------------
        |Manage Events
        |------------------------------
        */
        Route::resource('events','\App\Http\Controllers\Admin\EventsController');
        Route::get('events',[App\Http\Controllers\Admin\EventsController::class, 'index'])->name('events');
        Route::get('events/delete/{id}',[App\Http\Controllers\Admin\EventsController::class, 'delete']);
        Route::get('events/status/{id}',[App\Http\Controllers\Admin\EventsController::class, 'status']);

        /*
        |------------------------------
        |Manage Encuestas
        |------------------------------
        */
        Route::resource('survey','\App\Http\Controllers\Admin\SurveyController');
        Route::get('survey',[App\Http\Controllers\Admin\SurveyController::class, 'index'])->name('survey');
        Route::get('survey/delete/{id}',[App\Http\Controllers\Admin\SurveyController::class, 'delete']);
        Route::get('survey/status/{id}',[App\Http\Controllers\Admin\SurveyController::class, 'status']);

        /*
        |------------------------------
        |Manage Beacons
        |------------------------------
        */
        Route::resource('beacons','\App\Http\Controllers\Admin\BeaconsController');
        Route::get('beacons',[App\Http\Controllers\Admin\BeaconsController::class, 'index'])->name('beacons');
        Route::get('beacons/delete/{id}',[App\Http\Controllers\Admin\BeaconsController::class, 'delete']);
        Route::get('beacons/status/{id}',[App\Http\Controllers\Admin\BeaconsController::class, 'status']);

        /*
        |------------------------------
        |Manage AppUser
        |------------------------------
        */
        Route::resource('users','\App\Http\Controllers\Admin\AppUserController');
        Route::get('users',[App\Http\Controllers\Admin\AppUserController::class, 'index'])->name('users');
        Route::get('users/delete/{id}',[App\Http\Controllers\Admin\AppUserController::class, 'delete']);
        Route::get('users/status/{id}',[App\Http\Controllers\Admin\AppUserController::class, 'status']);
    });
});

// Control de fallos
Route::fallback(function () {
    return view('errors.404'); // template should exists
});