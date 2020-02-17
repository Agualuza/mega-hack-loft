<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AreaContainsPoint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "
        CREATE OR REPLACE FUNCTION `area_contains_point`(lt DECIMAL(13,10),lg DECIMAL(13,10) , field_id INT) RETURNS tinyint(1)
        DETERMINISTIC
        BEGIN
        DECLARE xminus DECIMAL(13,10);
        DECLARE xplus DECIMAL(13,10);
        DECLARE yminus DECIMAL(13,10);
        DECLARE yplus DECIMAL(13,10);
        DECLARE count INT;
        
        SET count = 0;
        SELECT MAX(lat) INTO xplus FROM vertex where field_id = field_id;
        SELECT MIN(lat) INTO xminus FROM vertex where field_id = field_id;
        SELECT MAX(lng) INTO yplus FROM vertex where field_id = field_id;
        SELECT MIN(lng) INTO yminus FROM vertex where field_id = field_id;
        
        IF lt >= xminus THEN
                SET count = count + 1;
        END IF;
        
        IF lt <= xplus THEN
                SET count = count + 1;
        END IF;
        
        IF lg >= yminus THEN
                SET count = count + 1;
        END IF;
        
        IF lg <= yplus THEN
                SET count = count + 1;
        END IF;
        
        IF count = 4 THEN
                RETURN true;
        END IF;
        
        RETURN false;
        
        
        END;
        ";

        DB::unprepared($procedure);
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
