<?php

namespace App\Helpers;

class Helper {

    public static function percentageDice( $num , $numDice){
        switch($numDice){
            case 1:
                return self::calPercentage1( $num );
                break;
            case 2:
                return self::calPercentage2( $num );
                break;
            case 3:
                return self::calPercentage3( $num );
                break;            
            case 4:
                return self::calPercentage4( $num );
                break;           
            case 5:
                return self::calPercentage5( $num );
                break;
        }
        
    }

    private static function calPercentage1($numrand){
        $num1 = 10;
        $num2 = $num1 + 10;
        $num3 = $num2 + 20;
        $num4 = $num3 + 20;
        $num5 = $num4 + 20;

        if($numrand <= $num1){
            return 1;
        }else if($numrand <= $num2){
            return 2;
        }else if($numrand <= $num3){
            return 3;
        }else if($numrand <= $num4){
            return 4;
        }else if($numrand <= $num5){
            return 5;
        }else{
            return 6;
        }
    }
    private static function calPercentage2($numrand){
        $num1 = 10;
        $num2 = $num1 + 10;
        $num3 = $num2 + 20;
        $num4 = $num3 + 20;
        $num5 = $num4 + 20;

        if($numrand <= $num1){
            return 1;
        }else if($numrand <= $num2){
            return 2;
        }else if($numrand <= $num3){
            return 3;
        }else if($numrand <= $num4){
            return 4;
        }else if($numrand <= $num5){
            return 5;
        }else{
            return 6;
        }
    }
    private static function calPercentage3($numrand){
        $num1 = 10;
        $num2 = $num1 + 10;
        $num3 = $num2 + 20;
        $num4 = $num3 + 20;
        $num5 = $num4 + 20;

        if($numrand <= $num1){
            return 1;
        }else if($numrand <= $num2){
            return 2;
        }else if($numrand <= $num3){
            return 3;
        }else if($numrand <= $num4){
            return 4;
        }else if($numrand <= $num5){
            return 5;
        }else{
            return 6;
        }
    }
    private static function calPercentage4($numrand){
        $num1 = 10;
        $num2 = $num1 + 10;
        $num3 = $num2 + 20;
        $num4 = $num3 + 20;
        $num5 = $num4 + 20;

        if($numrand <= $num1){
            return 1;
        }else if($numrand <= $num2){
            return 2;
        }else if($numrand <= $num3){
            return 3;
        }else if($numrand <= $num4){
            return 4;
        }else if($numrand <= $num5){
            return 5;
        }else{
            return 6;
        }
    }
    private static function calPercentage5($numrand){
        $num1 = 10;
        $num2 = $num1 + 10;
        $num3 = $num2 + 20;
        $num4 = $num3 + 20;
        $num5 = $num4 + 20;

        if($numrand <= $num1){
            return 1;
        }else if($numrand <= $num2){
            return 2;
        }else if($numrand <= $num3){
            return 3;
        }else if($numrand <= $num4){
            return 4;
        }else if($numrand <= $num5){
            return 5;
        }else{
            return 6;
        }
    }
    
}