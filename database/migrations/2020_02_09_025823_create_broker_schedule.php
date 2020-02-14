<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrokerSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('broker_schedule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('broker_id')->unsigned();
            $table->foreign('broker_id')->references('id')->on('broker');
            $table->date('call_date')->nullable();
            $table->time('call_time')->nullable();
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
        Schema::dropIfExists('broker_schedule');
    }
}
