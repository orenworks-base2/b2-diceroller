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

    public function getDiceResult( Request $request ){
        return DiceService::getDiceResult( $request );
    }

}
