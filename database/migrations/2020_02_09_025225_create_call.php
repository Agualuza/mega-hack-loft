<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCall extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('broker_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->string("channel_url",255)->nullable();
            $table->string("access_code",255)->nullable();
            $table->foreign('broker_id')->references('id')->on('broker');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('status',1);
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
        Schema::dropIfExists('call');
    }
}
