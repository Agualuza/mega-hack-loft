<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVertex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vertex', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('area');
            $table->string('lat',30);
            $table->string('lng',30);
            $table->integer('order',3);
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
        Schema::dropIfExists('vertex');
    }
}
