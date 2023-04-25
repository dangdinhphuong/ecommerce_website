<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCustomerRanksTable extends Migration
{
    public function up()
    {
        Schema::table('customer_ranks', function (Blueprint $table) {
            $table->char('icon')->nullable();
            $table->char('color')->nullable();
        });
    }

    public function down()
    {
        Schema::table('customer_ranks', function (Blueprint $table) {
            $table->dropColumn(['icon', 'color']);
        });
    }
}