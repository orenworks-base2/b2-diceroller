<?php

namespace App\Services;

use Illuminate\Support\Facades\{
    Crypt,
    DB,
    Hash,
    Validator,
};

use App\Models\{
    User,
};

use Illuminate\Validation\Rules\Password;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;

class UserService {

    public static function createUser( $request ) {
        
        $validator = Validator::make( $request->all(), [
            
            'phone_number' => [ 'required', 'digits_between:8,15', function( $attribute, $value, $fail ) use ( $request ) {

                $user = User::where( 'phone_number', $value )->first();

                if ( $user ) {
                    $fail = 'No change for roll';
                }
            } ],
        ] );

        $attributeName = [
            'phone_number' =>  'phone_number' ,
        ];

        $validator->setAttributeNames( $attributeName )->validate();

        DB::beginTransaction();

        $user = User::where( 'phone_number', $request->phone_number )->first();
        
        if( $user ){ 
            return response()->json([
                'message' => 'No change for roll'
            ], 401);
        }

        try {
            
            $createUserObject['user'] = [
                'phone_number' => $request->phone_number,
                'password' => '123',
            ];

            $createUser = User::create( $createUserObject['user'] );

            DB::commit();

            if (Auth::attempt(['phone_number' => $request->phone_number,'password' => '123'])) {
                return response()->json([
                    'message_key' => 'Register Successful',
                    'data' => [],
                ]);
            } else {
                return response()->json([
                    'message' => 'Login failed'
                ], 401);
            }

        } catch ( \Throwable $th ) {

            DB::rollBack();

            return response()->json( [
                'message' => $th->getMessage() . ' in line: ' . $th->getLine()
            ], 500 );
        }
    }

    public static function logout(){
        $currentUser = auth()->user();
        $user_id = $currentUser->id;

        $user = User::find($user_id);
        if($user->result == null){
            $user->delete();
        }
        return true;
    }

}