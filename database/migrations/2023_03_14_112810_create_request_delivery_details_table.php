<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestDeliveryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_delivery_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_delivery_id')->constrained('request_deliveries');
            $table->foreignId('meter_request_id')->constrained();
            $table->string('meter_number')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('remaining');
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
        Schema::dropIfExists('request_delivery_details');
    }
}
