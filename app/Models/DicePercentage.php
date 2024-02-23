<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DicePercentage extends Model
{
    use HasFactory;

    protected $fillable = [
        'dice_num',
        'num1',
        'num2',
        'num3',
        'num4',
        'num5',
        'num6',
    ];
}
