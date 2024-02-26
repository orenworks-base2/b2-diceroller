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

    public static function getPercentage(){

        $resultDice = DicePercentage::all();

        return response()->json( [
            'message_key' => 'get_Percentage_success',
            'data' => $resultDice,
        ] );
    }

    public static function changePercentage( $request ){

        DB::beginTransaction();

        try{

            for( $i = 1; $i <= count($request->diceData['num1']); $i++ ){
                $dicePercentage = DicePercentage::where( 'dice_num', $i )->first();
                $dicePercentage->num1 = $request->diceData['num1'][$i-1];
                $dicePercentage->num2 = $request->diceData['num2'][$i-1] + $dicePercentage->num1;
                $dicePercentage->num3 = $request->diceData['num3'][$i-1] + $dicePercentage->num2;
                $dicePercentage->num4 = $request->diceData['num4'][$i-1] + $dicePercentage->num3;
                $dicePercentage->num5 = $request->diceData['num5'][$i-1] + $dicePercentage->num4;
                $dicePercentage->num6 = $request->diceData['num6'][$i-1] + $dicePercentage->num5;
                $dicePercentage->save();
            }

            DB::commit();

        } catch ( \Throwable $th ) {

            DB::rollBack();

            return response()->json( [
                'message_key' => 'change_Result_fail',
                'data' => $th->getMessage() . ' in line: ' . $th->getLine(),
            ] );
        }

        return response()->json( [
            'message_key' => 'change_Result_success',
            'data' => [],
        ] );
    }

    public static function checkUser(){

        $currentUser = auth()->user();
        $user_id = $currentUser->id;

        $record = diceResult::where( 'user_id', $user_id )->first();

        if( $record ){
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

        

        try{
            $currentUser = auth()->user();
            $user_id = $currentUser->id;
            
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