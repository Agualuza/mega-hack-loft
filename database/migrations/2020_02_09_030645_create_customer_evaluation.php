<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerEvaluation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_evaluation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('call_id')->unsigned();
            $table->bigInteger('customer_user_id')->unsigned();
            $table->bigInteger('broker_id')->unsigned();
            $table->foreign('call_id')->references('id')->on('call');
            $table->foreign('customer_user_id')->references('id')->on('users');
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
        Schema::dropIfExists('customer_evaluation');
    }
}
