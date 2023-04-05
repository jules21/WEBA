<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeDescOptionalToPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->longText('description')->nullable()->change();
            $table->dropColumn(['subtotal', 'tax_net_amount']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {

            $table->longText('description')->change();
            $table->decimal('subtotal', 18, 2)->nullable();
            $table->decimal('tax_net_amount', 18, 2)->nullable();

        });
    }
}
