<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER prevent_delete_trigger_app_access
            BEFORE DELETE ON app_access FOR EACH ROW
            BEGIN
                SIGNAL SQLSTATE "45000"
                SET MESSAGE_TEXT = "Delete operations are not allowed on this table.";
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER prevent_delete_trigger_users_table
            BEFORE DELETE ON users FOR EACH ROW
            BEGIN
                SIGNAL SQLSTATE "45000"
                SET MESSAGE_TEXT = "Delete operations are not allowed on this table.";
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER prevent_delete_trigger_applications
            BEFORE DELETE ON applications FOR EACH ROW
            BEGIN
                SIGNAL SQLSTATE "45000"
                SET MESSAGE_TEXT = "Delete operations are not allowed on this table.";
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER prevent_delete_trigger_activity_logs
            BEFORE DELETE ON activity_logs FOR EACH ROW
            BEGIN
                SIGNAL SQLSTATE "45000"
                SET MESSAGE_TEXT = "Delete operations are not allowed on this table.";
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER prevent_delete_trigger_sequence_tbls
            BEFORE DELETE ON sequence_tbls FOR EACH ROW
            BEGIN
                SIGNAL SQLSTATE "45000"
                SET MESSAGE_TEXT = "Delete operations are not allowed on this table.";
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER prevent_delete_trigger_user_logs
            BEFORE DELETE ON user_logs FOR EACH ROW
            BEGIN
                SIGNAL SQLSTATE "45000"
                SET MESSAGE_TEXT = "Delete operations are not allowed on this table.";
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS prevent_delete_trigger_app_access');
        DB::unprepared('DROP TRIGGER IF EXISTS prevent_delete_trigger_users_table');
        DB::unprepared('DROP TRIGGER IF EXISTS prevent_delete_trigger_applications');
        DB::unprepared('DROP TRIGGER IF EXISTS prevent_delete_trigger_activity_logs');
        DB::unprepared('DROP TRIGGER IF EXISTS prevent_delete_trigger_sequence_tbls');
        DB::unprepared('DROP TRIGGER IF EXISTS prevent_delete_trigger_user_logs');
    }
};
