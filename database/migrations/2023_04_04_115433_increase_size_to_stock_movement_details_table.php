<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IncreaseSizeToStockMovementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_movement_details', function (Blueprint $table) {
            $table->decimal('unit_price', 20, 2)->change();
            $table->decimal('vat', 20, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_movement_details', function (Blueprint $table) {
            $table->decimal('unit_price', 10, 2)->change();
            $table->decimal('vat', 10, 2)->change();
        });
    }
}
