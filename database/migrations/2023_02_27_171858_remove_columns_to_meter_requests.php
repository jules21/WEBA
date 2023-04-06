<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsToMeterRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meter_requests', function (Blueprint $table) {
            $table->dropForeign('meter_requests_meter_id_foreign');
            $table->dropForeign('meter_requests_request_type_id_foreign');
            $table->dropColumn(['meter_id', 'request_type_id']);
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

        });
    }
}
