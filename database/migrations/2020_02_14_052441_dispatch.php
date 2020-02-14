<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class Dispatch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "
        CREATE OR REPLACE FUNCTION `dispatch`() RETURNS tinyint(1)
        DETERMINISTIC
        BEGIN
        DECLARE done INTEGER DEFAULT 0;
        DECLARE can_dispatch INT;
        DECLARE dtime INT;
        DECLARE count_broker INT;
        DECLARE brid INT;
        DECLARE bl VARCHAR(1);
        DECLARE caid INT;
        DECLARE bid INT;
        DECLARE fid INT;
        DECLARE blevel VARCHAR(1);
        DECLARE plt DECIMAL(13,10);
        DECLARE plg DECIMAL(13,10);
        DECLARE cid INT;
        DECLARE r INT;
        DECLARE ct INT;
        DECLARE curs1 CURSOR FOR SELECT p.lat , p.lng , c.id FROM `call` c inner join call_property cp on cp.call_id = c.id inner join property p on p.id = cp.property_id WHERE c.status = 'W';
        DECLARE curs2 CURSOR FOR SELECT f.id , f.broker_id, b.`level` FROM field f inner join broker b on b.id = f.broker_id WHERE f.`status` = 'A';
        DECLARE cursblack CURSOR FOR SELECT broker_id, broker_level,call_id FROM dispatch_avaible WHERE broker_level = 'P' LIMIT 5;
        DECLARE cursdiamond CURSOR FOR SELECT broker_id, broker_level,call_id FROM dispatch_avaible WHERE broker_level = 'D' LIMIT 5;
        DECLARE cursgold CURSOR FOR SELECT broker_id, broker_level,call_id FROM dispatch_avaible WHERE broker_level = 'G' LIMIT 5;
        DECLARE curssilver CURSOR FOR SELECT broker_id, broker_level,call_id FROM dispatch_avaible WHERE broker_level = 'S' LIMIT 5;
        DECLARE cursbronze CURSOR FOR SELECT broker_id, broker_level,call_id FROM dispatch_avaible WHERE broker_level = 'B' LIMIT 5;
        DECLARE CONTINUE handler 
        FOR NOT found 
        SET done = 1; 
        
        CREATE TEMPORARY TABLE IF NOT EXISTS dispatch_avaible(
            `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            `broker_id` bigint(20) unsigned NOT NULL,
            `broker_level` varchar(1),
            `call_id` bigint(20) unsigned NOT NULL,
            PRIMARY KEY (`id`)
        );
        
        OPEN curs1;
            
            curs1: LOOP
                FETCH curs1 INTO plt,plg,cid;
                    IF done = 1 THEN 
                        SET done = 0; 
                        LEAVE curs1;
                    END IF;
                    OPEN curs2;
                    curs2: LOOP
                        FETCH curs2 INTO fid,bid,blevel;
                            IF done = 1 THEN 
                                SET done = 0; 
                                LEAVE curs2;
                            END IF;
                            SELECT area_contains_point(plt,plg,fid) INTO r;
                            IF (r = 1) THEN
                                INSERT INTO dispatch_avaible (broker_id,broker_level,call_id) VALUES (bid,blevel,cid);
                            END IF;
                    END LOOP curs2;
                    CLOSE curs2;
            END LOOP curs1;
        
        CLOSE curs1;
        
        OPEN cursblack;
            cursblack: LOOP
                FETCH cursblack INTO brid,bl,caid;
                IF done = 1 THEN 
                        SET done = 0; 
                        LEAVE cursblack;
                END IF;
                SELECT count(1) INTO can_dispatch FROM dispatch WHERE broker_id = brid and call_id = caid;
                IF can_dispatch < 1 THEN
                    SELECT count(1) INTO ct FROM dispatch WHERE call_id = caid;
                    IF ct > 0 THEN
                        SELECT dispatch_time INTO dtime FROM dispatch WHERE call_id = caid ORDER BY dispatch_time DESC LIMIT 1;
                    ELSE 
                        SET dtime = 0;
                    END IF;
                    INSERT INTO dispatch (broker_id,call_id,dispatch_time,created_at) VALUES (brid,caid,dtime+1,NOW());
                END IF;
            END LOOP cursblack;
        CLOSE cursblack;
        
        SELECT count(broker_id) INTO count_broker FROM dispatch WHERE dispatch_time = dtime+1;
        
        IF count_broker < 5 THEN
            OPEN cursdiamond;
            cursdiamond: LOOP
                FETCH cursdiamond INTO brid,bl,caid;
                IF done = 1 THEN 
                        SET done = 0; 
                        LEAVE cursdiamond;
                END IF;
                SELECT count(1) INTO can_dispatch FROM dispatch WHERE broker_id = brid and call_id = caid;
                IF can_dispatch < 1 THEN
                    SELECT count(1) INTO ct FROM dispatch WHERE call_id = caid;
                    IF ct > 0 THEN
                        SELECT dispatch_time INTO dtime FROM dispatch WHERE call_id = caid ORDER BY dispatch_time DESC LIMIT 1;
                    ELSE 
                        SET dtime = 0;
                    END IF;
                    INSERT INTO dispatch (broker_id,call_id,dispatch_time,created_at) VALUES (brid,caid,dtime+1,NOW());
                END IF;
            END LOOP cursdiamond;
        CLOSE cursdiamond;
        END IF;
        
        SELECT count(broker_id) INTO count_broker FROM dispatch WHERE dispatch_time = dtime+1;
        
        IF count_broker < 5 THEN
            OPEN cursgold;
            cursgold: LOOP
                FETCH cursgold INTO brid,bl,caid;
                IF done = 1 THEN 
                        SET done = 0; 
                        LEAVE cursgold;
                END IF;
                SELECT count(1) INTO can_dispatch FROM dispatch WHERE broker_id = brid and call_id = caid;
                IF can_dispatch < 1 THEN
                    SELECT count(1) INTO ct FROM dispatch WHERE call_id = caid;
                    IF ct > 0 THEN
                        SELECT dispatch_time INTO dtime FROM dispatch WHERE call_id = caid ORDER BY dispatch_time DESC LIMIT 1;
                    ELSE 
                        SET dtime = 0;
                    END IF;
                    INSERT INTO dispatch (broker_id,call_id,dispatch_time,created_at) VALUES (brid,caid,dtime+1,NOW());
                END IF;
            END LOOP cursgold;
        CLOSE cursgold;
        END IF;
        
        SELECT count(broker_id) INTO count_broker FROM dispatch WHERE dispatch_time = dtime+1;
        
        IF count_broker < 5 THEN
            OPEN curssilver;
            curssilver: LOOP
                FETCH curssilver INTO brid,bl,caid;
                IF done = 1 THEN 
                        SET done = 0; 
                        LEAVE curssilver;
                END IF;
                SELECT count(1) INTO can_dispatch FROM dispatch WHERE broker_id = brid and call_id = caid;
                IF can_dispatch < 1 THEN
                    SELECT count(1) INTO ct FROM dispatch WHERE call_id = caid;
                    IF ct > 0 THEN
                        SELECT dispatch_time INTO dtime FROM dispatch WHERE call_id = caid ORDER BY dispatch_time DESC LIMIT 1;
                    ELSE 
                        SET dtime = 0;
                    END IF;
                    INSERT INTO dispatch (broker_id,call_id,dispatch_time,created_at) VALUES (brid,caid,dtime+1,NOW());
                END IF;
            END LOOP curssilver;
        CLOSE curssilver;
        END IF;
        
        SELECT count(broker_id) INTO count_broker FROM dispatch WHERE dispatch_time = dtime+1;
        
        IF count_broker < 5 THEN
            OPEN cursbronze;
            cursbronze: LOOP
                FETCH cursbronze INTO brid,bl,caid;
                IF done = 1 THEN 
                        SET done = 0; 
                        LEAVE cursbronze;
                END IF;
                SELECT count(1) INTO can_dispatch FROM dispatch WHERE broker_id = brid and call_id = caid;
                IF can_dispatch < 1 THEN
                    SELECT count(1) INTO ct FROM dispatch WHERE call_id = caid;
                    IF ct > 0 THEN
                        SELECT dispatch_time INTO dtime FROM dispatch WHERE call_id = caid ORDER BY dispatch_time DESC LIMIT 1;
                    ELSE 
                        SET dtime = 0;
                    END IF;
                    INSERT INTO dispatch (broker_id,call_id,dispatch_time,created_at) VALUES (brid,caid,dtime+1,NOW());
                END IF;
            END LOOP cursbronze;
        CLOSE cursbronze;
        END IF;
        
        SELECT count(broker_id) INTO count_broker FROM dispatch WHERE dispatch_time = dtime+1;
        
        IF count_broker = 0 THEN
            RETURN false;
        END IF;
        
        RETURN true;
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
