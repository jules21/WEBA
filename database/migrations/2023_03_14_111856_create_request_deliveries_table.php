<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('requests');
            $table->string('batch_number')->nullable();
            $table->unsignedBigInteger('done_by');
            $table->string('delivered_by_name')->nullable();
            $table->string('delivered_by_phone')->nullable();
            $table->date('delivery_date')->nullable();
            $table->timestamps();

            $table->unique(['request_id', 'batch_number']);
            $table->foreign('done_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_deliveries');
    }
}
