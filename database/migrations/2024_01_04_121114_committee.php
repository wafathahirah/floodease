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
        Schema::create('committee', function (Blueprint $table) {
            $table->String('ComID');
            $table->String('SID');
            $table->unsignedInteger('PosID');
            $table->primary(['ComID','SID','PosID']);

            $table->foreign('SID')->references('SID')->on('staff')->onDelete('cascade');
            $table->foreign('PosID')->references('PosID')->on('position')->onDelete('cascade');

            $table->string("ComTask");
            $table->string("ComLeader");
            $table->date("ComDate");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('committee');

    }
};
