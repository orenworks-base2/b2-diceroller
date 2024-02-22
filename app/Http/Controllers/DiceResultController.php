<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiceResultController extends Controller
{
    public function index() {
        return view( 'home' );
    }
}
