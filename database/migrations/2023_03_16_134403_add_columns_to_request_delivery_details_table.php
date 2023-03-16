<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToRequestDeliveryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_delivery_details', function (Blueprint $table) {
            $table->bigInteger('meter_request_id')->nullable()->change();
            $table->foreignId('stock_movement_detail_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request_delivery_details', function (Blueprint $table) {
            //
        });
    }
}
