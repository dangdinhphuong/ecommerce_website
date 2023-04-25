<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Notifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->boolean('read')->default(0);
            $table->integer('order_id')->unsigned();
            $table->string('title');
            $table->string('desc')->nullable();
            $table->string('short_desc')->nullable();
            $table->dateTime('time_push')->nullable();
            $table->string('external_url')->nullable();
            $table->text('content')->nullable();
            $table->string('image_url')->nullable();
            $table->tinyInteger('group_type')->default(0);
            $table->string('topic')->nullable();
            $table->tinyInteger('noti_type')->default(0);
            $table->string('noti_id')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
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
        Schema::dropIfExists('notifications');
    }
}
