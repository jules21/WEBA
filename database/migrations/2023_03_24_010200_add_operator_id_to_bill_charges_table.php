<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOperatorIdToBillChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bill_charges', function (Blueprint $table) {
            $table->foreignId('operator_id')
                ->nullable()
                ->constrained('operators');
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
            $table->dropForeign('bill_charges_operator_id_foreign');
            $table->dropColumn('operator_id');
        });
    }
}
