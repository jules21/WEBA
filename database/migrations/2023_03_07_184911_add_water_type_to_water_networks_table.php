<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWaterTypeToWaterNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('water_networks', function (Blueprint $table) {
            $table->foreignId('water_network_type_id')
                ->nullable()
                ->constrained('water_network_types');
            $table->foreignId('operation_area_id')
                ->nullable()
                ->constrained('operation_areas');
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
            //
        });
    }
}
