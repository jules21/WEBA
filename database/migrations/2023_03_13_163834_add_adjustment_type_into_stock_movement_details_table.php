<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdjustmentTypeIntoStockMovementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_movement_details', function (Blueprint $table) {
            $table->string('adjustment_type')->nullable()->comment('increase or decrease');
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
            $table->dropColumn('adjustment_type');
        });
    }
}
