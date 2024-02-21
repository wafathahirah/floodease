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
        Schema::create('jkk_res', function (Blueprint $table) {
            $table->String('JKKID');
            $table->String('ResID');
            $table->primary(['JKKID','ResID']);

            $table->foreign('JKKID')->references('JKKID')->on('jkk')->onDelete('cascade');
            $table->foreign('ResID')->references('ResID')->on('resident')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jkk_res');

    }
};
