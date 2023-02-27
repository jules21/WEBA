<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_mappings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('psp_account_id');
            $table->foreignId('payment_configuration_id')->constrained();
            $table->timestamps();

            $table->foreign('psp_account_id')->references('id')->on('payment_service_provider_accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_mappings');
    }
}
