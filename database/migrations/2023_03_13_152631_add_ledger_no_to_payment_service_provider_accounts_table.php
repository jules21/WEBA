<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLedgerNoToPaymentServiceProviderAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_service_provider_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('ledger_no')->nullable();
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
        Schema::table('payment_service_provider_accounts', function (Blueprint $table) {
            $table->dropForeign('payment_service_provider_accounts_ledger_no_foreign');
            $table->dropColumn('ledger_no');

        });
    }
}
