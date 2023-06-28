<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnMakeItNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grace_periods', function (Blueprint $table) {
            $table->foreignId('contract_id')->nullable()->change();
            $table->foreignId('operation_area_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grace_periods', function (Blueprint $table) {
            //
        });
    }
}
