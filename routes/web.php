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


Route::prefix( 'register' )->group( function() {
    Route::post( '/', [ AuthController::class, 'createUser' ] )->middleware( 'guest:admin' )->name( 'web.createUser' );
    Route::get( '/', [ AuthController::class, 'register' ] )->middleware( 'guest:admin' )->name( 'web.register' );
} );

Route::prefix( 'backoffice' )->group( function() {
    $limiter = config( 'fortify.limiters.login' );
    Route::get( 'login', [ AuthController::class, 'login' ] )->middleware( 'guest:admin' )->name( 'admin.login' );
    Route::post( 'login', [ AuthenticatedSessionController::class, 'store' ] )->middleware( array_filter( [ 'guest:admin', $limiter ? 'throttle:'.$limiter : null ] ) )->name( 'admin.admin_login' );
    Route::post( 'logout', [ AuthController::class, 'logoutLog' ] )->name( 'admin.logoutLog' );

    Route::middleware( [ 'auth:admin' ] )->group( function() {
        Route::get( '/admin', [ DiceResultController::class, 'admin' ] )->name( 'admin.admin' );
        Route::get( '/home', [ DiceResultController::class, 'home' ] )->name( 'admin.home' );

        Route::post( '/changedicePercentage', [ DiceResultController::class, 'changePercentage' ] )->name( 'admin.changedicePercentage' );
        Route::post( '/getResult', [ DiceResultController::class, 'getResultUser' ] )->name( 'admin.getResultUser' );
        Route::get( '/getPercentage', [ DiceResultController::class, 'getPercentage' ] )->name( 'admin.getPercentage' );

    } );
} );

    Route::get( '/home', [ DiceResultController::class, 'index' ] )->name( 'web.home' );
    Route::get( '/diceResult', [ DiceResultController::class, 'getDiceResult' ] )->name( 'web.getDiceResult' );
    Route::get( '/getDiceNumber', [ DiceResultController::class, 'getDiceNumber' ] )->name( 'web.getDiceNumber' );
    Route::post( '/logout', [ AuthController::class, 'logoutLog' ] )->name( 'admin.logoutLog' );
