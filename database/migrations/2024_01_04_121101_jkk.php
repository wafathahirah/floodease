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
        Schema::create('jkk', function (Blueprint $table) {
            $table->String('JKKID')->primary();
            $table->String("JKKName");
            $table->String("JKKPhoneNum");
            $table->String("JKKEmail");
            $table->String("VillageName");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jkk');
    }
};
