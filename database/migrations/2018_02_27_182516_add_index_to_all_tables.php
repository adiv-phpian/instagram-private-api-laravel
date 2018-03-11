<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexToAllTables extends Migration
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
            $table->index('username');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->index('instagram_user_id');
            $table->index('instagram_target_user_id');
            $table->index('media_id');
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->index('instagram_user_id');
            $table->index('instagram_target_user_id');
            $table->index('media_id');
        });

        Schema::table('follows', function (Blueprint $table) {
            $table->index('instagram_user_id');
            $table->index('instagram_target_user_id');
        });

        Schema::table('queues', function (Blueprint $table) {
            $table->index('instagram_user_id');
            $table->index('action_id');
            $table->index('media_id');
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
        Schema::table('i_p_models', function (Blueprint $table) {
            $table->dropIndex('username');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropIndex('instagram_user_id');
            $table->dropIndex('instagram_target_user_id');
            $table->dropIndex('media_id');
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->dropIndex('instagram_user_id');
            $table->dropIndex('instagram_target_user_id');
            $table->dropIndex('media_id');
        });

        Schema::table('follows', function (Blueprint $table) {
            $table->dropIndex('instagram_user_id');
            $table->dropIndex('instagram_target_user_id');
        });

        Schema::table('queues', function (Blueprint $table) {
            $table->dropIndex('instagram_user_id');
            $table->dropIndex('action_id');
            $table->dropIndex('media_id');
        });
    }
}
