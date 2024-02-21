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
        Schema::create('aid', function (Blueprint $table) {
            $table->unsignedInteger('AidID')->autoIncrement();
            $table->String("ItemName");
            $table->String("AidType");
            $table->Integer("TotalAid");
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aid');

    }
};
