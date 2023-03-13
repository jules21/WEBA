<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('debit_ledger_croup');
            $table->unsignedBigInteger('debit_ledger');
            $table->unsignedBigInteger('credit_ledger_croup');
            $table->unsignedBigInteger('credit_ledger');
            $table->foreignId('currency_id')->nullable()->constrained()->cascadeOnDelete();
            $table->decimal('amount', 18);
            $table->text('description');
            $table->foreignId('operation_area_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();

            $table->foreign('debit_ledger_croup')->references('id')->on('chart_accounts');
            $table->foreign('debit_ledger')->references('id')->on('chart_accounts');
            $table->foreign('credit_ledger_croup')->references('id')->on('chart_accounts');
            $table->foreign('credit_ledger')->references('id')->on('chart_accounts');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journal_entries');
    }
}
