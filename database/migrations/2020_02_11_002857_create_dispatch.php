<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispatch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatch', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('broker_id')->unsigned();
            $table->bigInteger('call_id')->unsigned();
            $table->integer('dispatch_time')->nullable();
            $table->foreign('broker_id')->references('id')->on('broker');
            $table->foreign('call_id')->references('id')->on('call');
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
        Schema::dropIfExists('dispatch');
    }
}
