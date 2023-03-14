<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDeclarationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_declarations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->nullable()->constrained();
            $table->foreignId('payment_configuration_id')->constrained();
            $table->decimal('amount', 18);
            $table->string('payment_reference')->nullable();
            $table->string('type');
            $table->decimal('balance', 18);
            $table->string('status')->default('active');
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
        Schema::dropIfExists('payment_declarations');
    }
}
