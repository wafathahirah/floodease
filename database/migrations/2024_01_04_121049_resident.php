<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resident', function (Blueprint $table) {
            $table->String('ResID')->primary();
            $table->String("ResDependencies");
            $table->String("HouseCondition");
            $table->String("ResName");
            $table->String("ResCity");
            $table->String("ResStreet");
            $table->String("ResPastAid");
            $table->timestamps();     
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resident');

    }
};
