<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dice_percentages', function (Blueprint $table) {
            $table->id();
            $table->string('dice_num');
            $table->string('num1');
            $table->string('num2');
            $table->string('num3');
            $table->string('num4');
            $table->string('num5');
            $table->string('num6');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dice_percentages');
    }
};
