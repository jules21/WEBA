<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CorrectionToBillChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bill_charges', function (Blueprint $table) {
            $table->dropForeign('bill_charges_operator_id_foreign');
            $table->dropColumn(['operator_id', 'unit-price']);

            $table->foreignId('operation_area_id')->constrained();
            $table->decimal('unit_price', 18);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bill_charges', function (Blueprint $table) {
            $table->dropForeign('bill_charges_operation_area_id_foreign');
            $table->dropColumn(['operation_area_id', 'unit_price']);

            $table->foreignId('operator_id')->constrained();
            $table->decimal('unit-price', 18);
        });
    }
}
