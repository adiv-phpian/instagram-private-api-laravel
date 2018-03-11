<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdateColumnsToIpTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('i_p_models', function (Blueprint $table) {
            $table->dateTime('last_comment_request')->nullable();
            $table->dateTime('last_like_request')->nullable();
            $table->dateTime('last_follow_request')->nullable();
        });
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
