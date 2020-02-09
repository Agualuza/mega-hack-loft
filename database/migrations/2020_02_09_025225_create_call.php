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
            $table->integer('broker_user_id')->unsigned();
            $table->integer('customer_user_id')->unsigned();
            $table->foreign('broker_user_id')->references('id')->on('user');
            $table->foreign('customer_user_id')->references('id')->on('user');
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
