<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOpeningDateToPaymentServiceProviderAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_service_provider_accounts', function (Blueprint $table) {
            $table->date('opening_date')->nullable()->after('account_number');
            $table->date('closing_date')->nullable()->after('opening_date');
            $table->dropForeign('payment_service_provider_accounts_ledger_no_foreign');
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
            $table->dropColumn('opening_date');
            $table->dropColumn('closing_date');
        });
    }
}
