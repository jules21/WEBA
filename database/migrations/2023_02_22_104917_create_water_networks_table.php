<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaterNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('water_networks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedDouble('distance_covered');
            $table->unsignedInteger('population_covered');
            $table->foreignId('operator_id')->constrained('operators');
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
        Schema::dropIfExists('water_networks');
    }
}
