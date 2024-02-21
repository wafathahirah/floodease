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
        Schema::dropIfExists('staff');

        Schema::create('staff', function (Blueprint $table) {
            $table->string('SID')->primary();
            $table->string("SName");
            $table->string("SPhoneNum");
            $table->string("SAddress");
            $table->string("SEmail");
            $table->string("SPwd");
            $table->string("SRole");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
};
