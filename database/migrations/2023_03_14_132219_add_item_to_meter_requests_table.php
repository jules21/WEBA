<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemToMeterRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meter_requests', function (Blueprint $table) {
            $table->foreignId('item_category_id')->nullable()->constrained();
            $table->foreignId('item_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meter_requests', function (Blueprint $table) {
            $table->dropForeign(['meter_requests_item_category_id_foreign']);
            $table->dropForeign(['meter_requests_item_id_foreign']);
        });
    }
}
