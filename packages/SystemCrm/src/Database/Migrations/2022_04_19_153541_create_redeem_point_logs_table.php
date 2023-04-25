<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedeemPointLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redeem_point_logs', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('employee_id')->nullable();
            $table->integer('point')->default(0)->unsigned();
            $table->integer('total_point')->default(0)->unsigned();
            $table->string('dr_cr')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('payment_method')->nullable();
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
        Schema::dropIfExists('redeem_point_logs');
    }
}
