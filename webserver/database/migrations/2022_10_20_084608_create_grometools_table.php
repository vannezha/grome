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
        Schema::create('grometools', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('username',24);
            $table->string('guid',100)->unique();
            $table->string('variable')->nullable();
            $table->string('setpoint')->nullable();
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
        Schema::dropIfExists('grometools');
    }

    // public function
};
