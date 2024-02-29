<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DicePercentageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'dice_percentages' )->insert([
            'dice_num' => '1',
            'num1' => '16',
            'num2' => '16',
            'num3' => '17',
            'num4' => '17',
            'num5' => '17',
            'num6' => '17',
        ]);
        DB::table( 'dice_percentages' )->insert([
            'dice_num' => '2',
            'num1' => '16',
            'num2' => '16',
            'num3' => '17',
            'num4' => '17',
            'num5' => '17',
            'num6' => '17',
        ]);
        DB::table( 'dice_percentages' )->insert([
            'dice_num' => '3',
            'num1' => '16',
            'num2' => '16',
            'num3' => '17',
            'num4' => '17',
            'num5' => '17',
            'num6' => '17',
        ]);
        DB::table( 'dice_percentages' )->insert([
            'dice_num' => '4',
            'num1' => '16',
            'num2' => '16',
            'num3' => '17',
            'num4' => '17',
            'num5' => '17',
            'num6' => '17',
        ]);
        DB::table( 'dice_percentages' )->insert([
            'dice_num' => '5',
            'num1' => '16',
            'num2' => '16',
            'num3' => '17',
            'num4' => '17',
            'num5' => '17',
            'num6' => '17',
        ]);

    }
}
