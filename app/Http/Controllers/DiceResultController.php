<?php

namespace App\Http\Controllers;

use App\Services\DiceService;
use Illuminate\Http\Request;

class DiceResultController extends Controller
{
    public function index() {
        return view( 'client.home');

    }

    public function home() {
        
        return view( 'admin.home' );

    }

    public function admin() {
        
        return view( 'admin.changePercentege' );

    }

    public function getDiceResult(){
        return DiceService::getDiceResult();
    }

    public function getDiceNumber( Request $request ){
        return DiceService::getDiceNumber( $request );
    }

    public function changePercentage( Request $request ){
        return DiceService::changePercentage( $request );
    }

    public function getResultUser( Request $request ){
        return DiceService::getResultUser( $request );
    }

    public function getPercentage(){
        return DiceService::getPercentage();
    }
}
