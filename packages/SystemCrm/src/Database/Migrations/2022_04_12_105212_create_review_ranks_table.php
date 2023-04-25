<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_ranks', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_rank_id')->default(0);
            $table->decimal('spending_norm_amount', 16,2)->default(0);
            $table->tinyInteger('change_type')->default(3);
            $table->string('demote_rank')->nullable();
            $table->tinyInteger('maintain_type')->default(0);
            $table->decimal('amount_value',16,2)->default(0);
            //$table->decimal('reset_amount',16,2)->default(0);
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
        Schema::dropIfExists('review_ranks');
    }
}
