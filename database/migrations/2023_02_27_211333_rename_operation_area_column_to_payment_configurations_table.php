<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameOperationAreaColumnToPaymentConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_configurations', function (Blueprint $table) {
            $table->dropForeign('payment_configurations_operation_area_foreign');
            $table->renameColumn('operation_area', 'operation_area_id');
            $table->foreign('operation_area_id')->references('id')->on('operation_areas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_configurations', function (Blueprint $table) {
            $table->renameColumn('operation_area_id', 'operation_area');
        });
    }
}
