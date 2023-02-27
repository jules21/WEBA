<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained();
            $table->foreignId('operation_area_id')->constrained();
            $table->integer('opening_qty');
            $table->float('qty_in')->default(0);
            $table->float('qty_out')->default(0);
            $table->text('description');
            $table->string('type')->comment('Adjustment,Purchase,Sale');
            $table->foreignId('adjustment_id')->nullable()->constrained();
            $table->foreignId('purchase_id')->nullable()->constrained();
            $table->foreignId('request_id')->nullable()->constrained();
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
        Schema::dropIfExists('stock_movements');
    }
}
