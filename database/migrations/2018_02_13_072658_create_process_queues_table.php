<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_queues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('instagram_user_id');
            $table->string('target_user_id');
            $table->integer('action_id');
            $table->string('media_id')->default(0);
            $table->string('done')->default(0);
            $table->text('comment');
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
        Schema::dropIfExists('process_queues');
    }
}
