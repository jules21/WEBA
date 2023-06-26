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
            $table->string('license_number');
            $table->date('valid_from');
            $table->date('valid_to');
            $table->string('status');
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
