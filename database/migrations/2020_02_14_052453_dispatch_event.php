<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class DispatchEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        $query = "
        SET GLOBAL event_scheduler = ON;
        CREATE OR REPLACE EVENT dispatch_event
        ON SCHEDULE EVERY 30 SECOND
        ON COMPLETION PRESERVE
        DO
        SELECT dispatch();
        ";
        DB::statement($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
