<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('broker_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('area_id')->unsigned()->nullable();
            $table->string('name',50);
            $table->string('border_color',10);
            $table->string('fill_color',10);
            $table->foreign('broker_id')->references('id')->on('broker');
            $table->foreign('city_id')->references('id')->on('city');
            $table->foreign('area_id')->references('id')->on('area');
            $table->string('status');
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
        Schema::dropIfExists('field');
    }
}
