<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFacebookLoginColumns extends Migration
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
            $table->boolean('is_facebook_login')->after('user_info')->default(false);
            $table->string('facebook_access_token');
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
        Schema::table('tableName', function (Blueprint $table)
        {
            $table->dropColumn(['is_facebook_login', 'facebook_access_token']);
        });
    }
}
