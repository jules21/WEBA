<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_movements', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('transaction_type');
            $table->bigInteger('psp_id');
            $table->bigInteger('psp_account_id');
            $table->bigInteger('source_ledger');
            $table->bigInteger('destination_ledger');
            $table->foreignId('currency_id')->nullable()->constrained();
            $table->decimal('amount');
            $table->text('description');
            $table->string('reference_no')->nullable();
            $table->foreignId('operation_area_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();

            $table->foreign('source_ledger')->references('id')->on('chart_accounts');
            $table->foreign('destination_ledger')->references('id')->on('chart_accounts');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_movements');
    }
}
