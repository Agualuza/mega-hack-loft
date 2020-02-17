<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProperty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('address')->nullable();
            $table->decimal('lat',13,10)->nullable();
            $table->decimal('lng',13,10)->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('city_id')->references('id')->on('city');
            $table->string('neighborhood',50)->nullable();
            $table->string('type',1)->nullable();
            $table->string('status',1);
            $table->mediumText('description')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->smallInteger('room')->nullable();
            $table->tinyInteger('pool')->nullable();
            $table->tinyInteger('garage')->nullable();
            $table->tinyInteger('furnished')->nullable();
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
        Schema::dropIfExists('property');
    }
}
