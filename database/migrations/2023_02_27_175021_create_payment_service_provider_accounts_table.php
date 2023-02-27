<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentServiceProviderAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_service_provider_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_service_provider_id')->constrained();
            $table->string('account_name');
            $table->string('account_number');
            $table->string('currency');
            $table->foreignId('operation_area_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_service_provider_accounts');
    }
}
