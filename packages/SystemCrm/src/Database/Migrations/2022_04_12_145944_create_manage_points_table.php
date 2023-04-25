<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_points', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('manage_type')->default(0);
            $table->tinyInteger('active')->default(0);
            $table->integer('point_cost')->default(0);
            $table->integer('reward_value')->default(0);
            $table->json('rank_ids_are_billed_points')->nullable();
            $table->json('customer_rank_id')->nullable();
            $table->boolean('apply_for_order_discount')->nullable();
            $table->boolean('apply_for_order_voucher')->nullable();
            $table->tinyInteger('apply_type')->default(1);
            $table->integer('rate')->nullable();
            $table->integer('rate_change')->nullable();
            $table->dateTime('active_from_date')->nullable();
            $table->dateTime('expired_to_date')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('manage_points');
    }
}
