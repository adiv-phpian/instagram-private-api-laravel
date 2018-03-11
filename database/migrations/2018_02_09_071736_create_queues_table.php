<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('instagram_user_id');
            $table->integer('action_id');
            $table->string('media_id')->default('');
            $table->integer('count');
            $table->integer('finished_count')->default(0);
            $table->integer('onqueue')->default(0);
            $table->string('comment')->default('');
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
        Schema::dropIfExists('queues');
    }
}
