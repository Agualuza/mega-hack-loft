<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispatchLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatch_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('call_id')->unsigned();
            $table->foreign('call_id')->references('id')->on('call');
            $table->mediumText('dispatch_message');
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
        Schema::dropIfExists('dispatch_log');
    }
}
