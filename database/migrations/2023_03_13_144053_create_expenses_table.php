<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operation_area_id')->constrained();
            $table->date('date');
            $table->decimal('amount', 18);
            $table->text('description');
            $table->bigInteger('expense_ledger');
            $table->bigInteger('expense_category');
            $table->bigInteger('payment_ledger');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();

            $table->foreign('expense_category')->references('id')->on('chart_accounts');
            $table->foreign('payment_ledger')->references('id')->on('chart_accounts');
            $table->foreign('expense_ledger')->references('id')->on('chart_accounts');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
