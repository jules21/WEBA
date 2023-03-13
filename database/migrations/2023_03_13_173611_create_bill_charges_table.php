<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_charges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operator_id')->constrained();
            $table->foreignId('water_network_type_id')->constrained();
            $table->decimal('unit-price', 18);
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
        Schema::dropIfExists('bill_charges');
    }
}
