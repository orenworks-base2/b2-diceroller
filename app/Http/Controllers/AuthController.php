<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\{
    UserService,
};


class AuthController extends Controller
{

    public function login() {
        return view( 'login' );
    }

    public function register() {
        return view( 'register' );
    }

    public function createUser( Request $request ) {
        return UserService::createUser( $request );
    }

    public function logout(){
        UserService::logout();
        
        auth()->guard( 'web' )->logout();
        return redirect()->route( 'web.register' );
    }

}
