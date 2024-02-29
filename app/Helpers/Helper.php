<?php

namespace App\Helpers;

use App\Models\{
    DicePercentage,
    diceResult,
};

class Helper {

    public static function assetVersion() {
        return '?v=1.05';
    }
    
    public static function percentageDice( $num , $numDice){
        return self::calPercentage( $num, $numDice );
    }

    public static function columnIndex( $object, $search ) {
        foreach ( $object as $key => $o ) {
            if ( $o['id'] == $search ) {
                return $key;
            }
        }
    }

    private static function calPercentage( $numrand, $numDice ){

        $dice = DicePercentage::where( 'dice_num', $numDice )->first();

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