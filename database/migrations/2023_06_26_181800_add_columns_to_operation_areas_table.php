<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOperationAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('operation_areas', function (Blueprint $table) {
            $table->string('license_number')->nullable();
            $table->date('valid_from')->nullable();
            $table->date('valid_to')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('operation_areas', function (Blueprint $table) {
            $table->dropColumn('license_number');
            $table->dropColumn('valid_from');
            $table->dropColumn('valid_to');
            $table->dropColumn('status');
        });
    }
}
