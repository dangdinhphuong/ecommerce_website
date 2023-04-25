<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_ranks', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->decimal('spending_norm_amount',16,2)->default(0);
            $table->decimal('point_invoice',16,2)->default(0);
            $table->tinyInteger('maintain_type')->default(1);
            $table->tinyInteger('active')->default(0);
            $table->tinyInteger('review_customer_rank')->default(0);
            //$table->decimal('standard_amount',16,2)->default(0);
            $table->decimal('amount_value',16,2)->default(0);
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
        Schema::dropIfExists('customer_ranks');
    }
}
