<?php

use App\Http\Controllers\{
    AuthController,
    DiceResultController,
};
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Helpers\Helper;
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

Route::get( 'login', [ AuthController::class, 'login' ] )->middleware( 'guest:web' )->name( 'web.login' );

    Route::prefix( 'register' )->group( function() {
        Route::post( '/', [ AuthController::class, 'createUser' ] )->name( 'web.createUser' );
        Route::get( '/', [ AuthController::class, 'register' ] )->name( 'web.register' );
    } );

$limiter = config( 'fortify.limiters.login' );

Route::post( 'login', [ AuthenticatedSessionController::class, 'store' ] )->middleware( array_filter( [ 'guest:web', $limiter ? 'throttle:'.$limiter : null ] ) )->name( 'web.user_login' );

Route::get( '/home', [ DiceResultController::class, 'index' ] )->name( 'web.home' );

Route::post( '/diceResult', [ DiceResultController::class, 'getDiceResult' ] )->name( 'web.getDiceResult' );

