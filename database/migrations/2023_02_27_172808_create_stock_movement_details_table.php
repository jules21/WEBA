<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockMovementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_movement_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained();
            $table->integer('quantity');
            $table->string('status');
            $table->decimal('unit_price');
            $table->string('type');
            $table->integer('model_id');
            $table->string('model_type');
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
        Schema::dropIfExists('stock_movement_details');
    }
}
