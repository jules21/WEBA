<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestDurationConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_duration_configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_type_id')->constrained('request_types');
            $table->foreignId('operator_id')->constrained('operators');
            $table->unsignedBigInteger('operation_area');
            $table->unsignedInteger('processing_days');
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
        Schema::dropIfExists('request_duration_configurations');
    }
}
