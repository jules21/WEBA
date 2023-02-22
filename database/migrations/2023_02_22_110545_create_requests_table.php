<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('operator_id')->constrained('operators');
            $table->foreignId('request_type_id')->constrained('request_types');
            $table->foreignId('meter_id')->nullable()->constrained('meters');
            $table->foreignId('water_usage_id')->constrained('water_usages');
            $table->longText('description');
            $table->foreignId('province_id')->nullable()->constrained();
            $table->foreignId('district_id')->nullable()->constrained();
            $table->foreignId('sector_id')->nullable()->constrained();
            $table->foreignId('cell_id')->nullable()->constrained();
            $table->foreignId('village_id')->nullable()->constrained();
            $table->boolean('new_connection_crosses_road')->nullable();
            $table->string('road_type')->nullable();
            $table->boolean('equipment_payment')->nullable();
            $table->boolean('digging_pipeline')->nullable();
            $table->string('pipe_cross')->nullable()->comment("Will your pipe cross a road (pavement or dirt), creek, river, swamp, fence, other people's land etc.");

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
        Schema::dropIfExists('requests');
    }
}
