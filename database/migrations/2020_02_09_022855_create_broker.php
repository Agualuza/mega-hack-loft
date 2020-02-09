<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBroker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('broker', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('creci_state_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('creci',15);
            $table->foreign('creci_state_id')->references('id')->on('state');
            $table->foreign('city_id')->references('id')->on('city');
            $table->string('photo')->nullable();
            $table->mediumInteger('description')->nullable();
            $table->string('level',1);
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
        Schema::dropIfExists('broker');
    }
}
