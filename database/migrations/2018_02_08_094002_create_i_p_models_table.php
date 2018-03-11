<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIPModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_p_models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('instagram_user_id')->unique();
            $table->text('user_session');
            $table->text('user_info');
            $table->string('proxy');
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
        Schema::dropIfExists('i_p_models');
    }
}
