<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWaterNetworkStatusIdToWaterNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('water_networks', function (Blueprint $table) {
            $table->foreignId('water_network_status_id')
                ->nullable()
                ->constrained('water_network_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('water_networks', function (Blueprint $table) {
            $table->dropForeign("water_networks_water_network_status_id_foreign");
            $table->dropColumn('water_network_status_id');
        });
    }
}
