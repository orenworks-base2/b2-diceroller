<?php

namespace App\Services;

use Illuminate\Http\Request;
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
    DiceSetting,
    User,
};

use Carbon\Carbon;


class DiceService {

    public static function getPercentage(){

        $resultDice = DicePercentage::all();

        return response()->json( [
            'message_key' => 'get_Percentage_success',
            'data' => $resultDice,
        ] );
    }

    public static function getDiceNumber(){
        $dicenum = DiceSetting::first();

        return response()->json( [
            'message_key' => 'get_Percentage_success',
            'data' => $dicenum->diceNum,
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

            $dicenum = DiceSetting::first();
            $dicenum->diceNum = $request->diceNum;
            $dicenum->save();

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

    public static function getDiceResult(){

        $dice = DiceSetting::first();

        $diceNum = $dice->diceNum; 

        for( $i = 1; $i <= $diceNum; $i++ ){

            $numRand = rand(1,100);
            $resultDice[] = Helper::percentageDice( $numRand, $i );

        }

        DB::beginTransaction();

        try{
            $currentUser = auth()->user();
            $user_id = $currentUser->id;
            
            $user = user::find( $user_id );
            $user->result = json_encode($resultDice);
            $user->save();

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

    public static function getResultUser( Request $request ){

        $resultDice = User::select('phone_number','result', 'created_at')->where('result', '!=' , null);

        $filterObject = self::filter( $request, $resultDice );
        $User = $filterObject['model'];
        $filter = $filterObject['filter'];

        if ( $request->input( 'order.0.column' ) != 0 ) {
            $dir = $request->input( 'order.0.dir' );
            switch ( $request->input( 'order.0.column' ) ) {
                case 1:
                    $User->orderBy( 'phone_number', $dir );
                    break;
                case 2:
                    $User->orderBy( 'create_at', $dir );
                    break;
            }
        }

        $UserCount = $User->count();

        $limit = $request->length;
        $offset = $request->start;

        $Users = $User->skip( $offset )->take( $limit )->get();

        $User = User::select(
            DB::raw( 'COUNT(users.id) as total'
        ) );

        $filterObject = self::filter( $request, $User );
        $User = $filterObject['model'];
        $filter = $filterObject['filter'];

        $User = $User->first();

        $data = [
            'user' => $Users,
            'draw' => $request->draw,
            'recordsFiltered' => $filter ? $UserCount : $User->total,
            'recordsTotal' => $filter ? User::count() : $UserCount,
        ];

        return $data;
    }

    private static function filter( $request, $model ){

        $filter = false;

        if ( !empty( $request->phone_number ) ) {
            $model->where('users.phone_number', 'LIKE', '%'. $request->phone_number .'%')->get();
            $filter = true;
        }

        if ( !empty( $request->created_at ) ) {
            if ( str_contains( $request->created_at, 'to' ) ) {
                $dates = explode( ' to ', $request->created_at );

                $startDate = explode( '-', $dates[0] );
                $start = Carbon::create( $startDate[0], $startDate[1], $startDate[2], 0, 0, 0, 'Asia/Kuala_Lumpur' );
                
                $endDate = explode( '-', $dates[1] );
                $end = Carbon::create( $endDate[0], $endDate[1], $endDate[2], 23, 59, 59, 'Asia/Kuala_Lumpur' );

                $model->whereBetween( 'created_at', [ date( 'Y-m-d H:i:s', $start->timestamp ), date( 'Y-m-d H:i:s', $end->timestamp ) ] );
            } else {

                $dates = explode( '-', $request->created_at );

                $start = Carbon::create( $dates[0], $dates[1], $dates[2], 0, 0, 0, 'Asia/Kuala_Lumpur' );
                $end = Carbon::create( $dates[0], $dates[1], $dates[2], 23, 59, 59, 'Asia/Kuala_Lumpur' );

                $model->whereBetween( 'created_at', [ date( 'Y-m-d H:i:s', $start->timestamp ), date( 'Y-m-d H:i:s', $end->timestamp ) ] );
            }
            $filter = true;
        }

        return [
            'filter' => $filter,
            'model' => $model,
        ];
    }
}