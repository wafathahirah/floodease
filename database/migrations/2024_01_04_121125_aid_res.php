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
        Schema::create('aid_res', function (Blueprint $table) {
            $table->String('ComID');
            $table->String('ResID');
            $table->unsignedInteger('AidID');
            $table->string('aid_resStatus');
            $table->integer('aid_resQuantity');
    
            $table->primary(['ComID', 'ResID', 'AidID']);
    
            $table->foreign('ComID')->references('ComID')->on('committee')->onDelete('cascade');
            $table->foreign('ResID')->references('ResID')->on('resident')->onDelete('cascade');
            $table->foreign('AidID')->references('AidID')->on('aid')->onDelete('cascade');

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
        Schema::dropIfExists('aid_res');

    }
};
