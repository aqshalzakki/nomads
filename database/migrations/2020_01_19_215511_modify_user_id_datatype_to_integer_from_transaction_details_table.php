<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ModifyUserIdDatatypeToIntegerFromTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = "ALTER TABLE transaction_details MODIFY COLUMN user_id bigint(20)";
        DB::statement($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $query = "ALTER TABLE transaction_details MODIFY COLUMN user_id varchar";
        DB::statement($query);
    }
}
