<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClusterWaterNetworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cluster_water_network', function (Blueprint $table) {
            $table->foreignId('cluster_id')->constrained()->cascadeOnDelete();
            $table->foreignId('water_network_id')->constrained();
            $table->primary(['cluster_id', 'water_network_id']);
            $table->unique(['cluster_id', 'water_network_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cluster_water_network');
    }
}
