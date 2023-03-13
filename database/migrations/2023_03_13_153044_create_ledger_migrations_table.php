<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgerMigrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledger_migrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ledger_group');
            $table->unsignedBigInteger('ledger_category');
            $table->unsignedBigInteger('ledger_no');
            $table->decimal('amount', 18);
            $table->string('balance_type');
            $table->foreignId('currency_id')->constrained();
            $table->foreignId('operation_area_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();

            $table->foreign('ledger_group')->references('id')->on('chart_accounts');
            $table->foreign('ledger_category')->references('id')->on('chart_accounts');
            $table->foreign('ledger_no')->references('id')->on('chart_accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ledger_migrations');
    }
}
