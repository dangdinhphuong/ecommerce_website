<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->default(0);
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->integer('number_of_people')->default(0)->unsigned();
            $table->dateTime('reservation_time')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('description')->nullable();
            $table->string('note')->nullable();
            $table->json('additional')->nullable();
            $table->string('staff_id')->nullable();
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
        Schema::dropIfExists('customer_bookings');
    }
}
