<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLedgerNoToLedgerMigrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ledger_migrations', function (Blueprint $table) {
            $table->dropForeign('ledger_migrations_ledger_no_foreign');
            $table->dropColumn('ledger_no');
            $table->unsignedBigInteger('currency_id')->nullable()->change();

            $table->unsignedBigInteger('ledger_id')->nullable();
            $table->foreign('ledger_id')->references('id')->on('chart_accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ledger_migrations', function (Blueprint $table) {
            $table->dropForeign('ledger_migrations_ledger_id_foreign');
            $table->dropColumn('ledger_id');
            $table->unsignedBigInteger('ledger_no')->nullable();
            $table->foreign('ledger_no')->references('id')->on('chart_accounts');
        });
    }
}
