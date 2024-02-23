<?php

namespace App\Services;

use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\{
    Crypt,
    DB,
    Hash,
    Validator,
};

use App\Models\{
    DicePercentage,
    diceResult,
};

use Illuminate\Validation\Rules\Password;

class DiceService {

    public static function checkUser(){

        $currentUser = auth()->user();
        $user_id = $currentUser->id;

        $record = diceResult::where( 'user_id', $user_id )->first();

        if($record){
            return false;
        }

        return true;

    }

    public static function getDiceResult( $request ){

        $result = [];

        for( $i = 1; $i <= $request->diceNum; $i++ ){

            $numRand = rand(1,100);
            $resultDice[] = Helper::percentageDice( $numRand, $i );

        }

        DB::beginTransaction();

        $currentUser = auth()->user();
        $user_id = $currentUser->id;

        try{
            
            for( $i = 1; $i <= $request->diceNum ; $i++){
                $result = new diceResult;
                $result->user_id = $user_id;
                $result->diceNum = $i;
                $result->result = $resultDice[ $i - 1 ];
                $result->save();
            }
            
            DB::commit();

        } catch ( \Throwable $th ) {

            DB::rollBack();

            return response()->json( [
                'message_key' => 'get_Result_fail',
                'data' => $th->getMessage() . ' in line: ' . $th->getLine(),
            ] );
        }

        return response()->json( [
            'message_key' => 'get_Result_success',
            'data' => $resultDice,
        ] );

        
    }
}