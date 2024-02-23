<?php

namespace App\Http\Controllers;

use App\Services\DiceService;
use Illuminate\Http\Request;

class DiceResultController extends Controller
{
    public function index() {
        
        $haveChange = false;
        if(DiceService::checkUser()){
            $haveChange = true;
        }
        return view( 'home', ['haveChange' => $haveChange] );

    }

    public function admin() {
        
        return view( 'changePercentege' );

    }

    public function getDiceResult( Request $request ){
        return DiceService::getDiceResult( $request );
    }

    public function changePercentage( Request $request ){
        return DiceService::changePercentage( $request );
    }

    public function getPercentage(){
        return DiceService::getPercentage();
    }
}
