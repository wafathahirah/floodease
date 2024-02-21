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
        Schema::dropIfExists('aid_res');
        Schema::create('aid_res', function (Blueprint $table) {
            $table->id(); // This will create an auto-incremented primary key

            $table->string('ComID');
            $table->string('ResID');
            $table->unsignedInteger('AidID');
            $table->string('aid_resStatus');
            $table->integer('aid_resQuantity');
            $table->timestamps();
    
            $table->unique(['ComID', 'ResID', 'AidID']); // Use unique instead of primary for composite key
    
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
