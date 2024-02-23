<?php

namespace App\Helpers;

use App\Models\{
    DicePercentage,
    diceResult,
};

class Helper {

    public static function percentageDice( $num , $numDice){

        return self::calPercentage( $num, $numDice );
        
    }

    private static function calPercentage( $numrand, $numDice ){

        for( $i = 1; $i <= $numDice; $i++ ){
            $dice = DicePercentage::where( 'dice_num', $i )->first();

            if( $numrand <= $dice->num1 ){
                return 1;
            }else if( $numrand <= $dice->num2 ){
                return 2;
            }else if( $numrand <= $dice->num3 ){
                return 3;
            }else if( $numrand <= $dice->num4 ){
                return 4;
            }else if( $numrand <= $dice->num5 ){
                return 5;
            }else{
                return 6;
            }
        }
        
    }
    
}