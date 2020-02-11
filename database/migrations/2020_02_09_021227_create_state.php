<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateState extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('country_id')->unsigned();
            $table->string('name');
            $table->string('abbreviation',2);
            $table->foreign('country_id')->references('id')->on('country');
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
        Schema::dropIfExists('state');
    }
}
