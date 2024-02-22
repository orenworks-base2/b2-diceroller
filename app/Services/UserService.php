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

class UserService {

    public static function createUser( $request ) {
        
        DB::beginTransaction();

        $validator = Validator::make( $request->all(), [
            
            'phone_number' => [ 'required', 'digits_between:8,15', function( $attribute, $value, $fail ) use ( $request ) {

                $user = User::where( 'phone_number', $value )->first();

                if ( $user ) {
                    $fail( ' Invalid Phone Number ' );
                }
            } ],
            'password' => [ 'required', Password::min( 8 ) ],
        ] );

        $attributeName = [
            'phone_number' =>  'phone_number' ,
            'password' => 'password' ,
        ];

        $validator->setAttributeNames( $attributeName )->validate();

        try {

            $createUserObject['user'] = [
                'phone_number' => $request->phone_number,
                'password' => Hash::make( $request->password ),
            ];

            $createUser = self::create( $createUserObject );

            DB::commit();

            return response()->json( [
                'message_key' => 'register_success',
                'data' => [],
            ] );

        } catch ( \Throwable $th ) {

            DB::rollBack();

            return response()->json( [
                'message' => $th->getMessage() . ' in line: ' . $th->getLine()
            ], 500 );
        }
    }

    private static function create( $data ) {

        $createUser = User::create( $data['user'] );

        return $createUser;
    }

}