<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeterRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meter_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meter_id')->constrained();
            $table->foreignId('request_type_id')->constrained();
            $table->string('status');
            $table->timestamps();

            $table->unique(['meter_id', 'request_type_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meter_requests');
    }
}
