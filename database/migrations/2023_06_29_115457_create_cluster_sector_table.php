<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClusterSectorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cluster_sector', function (Blueprint $table) {
            $table->foreignId('cluster_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sector_id')->constrained();

            $table->primary(['cluster_id', 'sector_id']);
            $table->unique(['cluster_id', 'sector_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cluster_sector');
    }
}
