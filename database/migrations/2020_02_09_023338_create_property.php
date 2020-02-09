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
            $table->bigInteger('state_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('address');
            $table->string('lat',30);
            $table->string('lng',30);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('city_id')->references('id')->on('city');
            $table->foreign('state_id')->references('id')->on('state');
            $table->string('neighborhood',50);
            $table->string('type',1);
            $table->string('status',1);
            $table->mediumText('description')->nullable();
            $table->decimal('amount', 5, 2)->nullable();
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
