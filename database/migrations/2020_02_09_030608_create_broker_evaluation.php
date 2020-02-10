<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrokerEvaluation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('broker_evaluation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('call_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('broker_id')->unsigned();
            $table->foreign('call_id')->references('id')->on('call');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('broker_id')->references('id')->on('broker');
            $table->string('message')->nullable();
            $table->integer('score');
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
        Schema::dropIfExists('broker_evaluation');
    }
}
