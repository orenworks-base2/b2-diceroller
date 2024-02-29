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
            'num2' => '32',
            'num3' => '49',
            'num4' => '66',
            'num5' => '83',
            'num6' => '100',
        ]);
        DB::table( 'dice_percentages' )->insert([
            'dice_num' => '2',
            'num1' => '16',
            'num2' => '32',
            'num3' => '49',
            'num4' => '66',
            'num5' => '83',
            'num6' => '100',
        ]);
        DB::table( 'dice_percentages' )->insert([
            'dice_num' => '3',
            'num1' => '16',
            'num2' => '32',
            'num3' => '49',
            'num4' => '66',
            'num5' => '83',
            'num6' => '100',
        ]);
        DB::table( 'dice_percentages' )->insert([
            'dice_num' => '4',
            'num1' => '16',
            'num2' => '32',
            'num3' => '49',
            'num4' => '66',
            'num5' => '83',
            'num6' => '100',
        ]);
        DB::table( 'dice_percentages' )->insert([
            'dice_num' => '5',
            'num1' => '16',
            'num2' => '32',
            'num3' => '49',
            'num4' => '66',
            'num5' => '83',
            'num6' => '100',
        ]);

    }
}
