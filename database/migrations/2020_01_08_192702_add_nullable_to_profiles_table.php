<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
            $table->date('date_of_birth')->nullable()->change();
            $table->string('gender')->nullable()->change();
            $table->bigInteger('phone_number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('image')->change();
            $table->date('date_of_birth')->change();
            $table->string('gender')->change();
            $table->bigInteger('phone_number')->change();
        });
    }
}
