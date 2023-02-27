<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMeterToMeterRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meter_requests', function (Blueprint $table) {
            $table->foreignId('request_id')->constrained();
            $table->string('meter_number');
            $table->string('subscription_number')->unique();
            $table->decimal('last_index', 20);
            $table->decimal('balance', 18);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meter_requests', function (Blueprint $table) {

        });
    }
}
