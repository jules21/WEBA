<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveOperationAreaIdToWaterNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('water_networks', function (Blueprint $table) {
            $table->dropForeign('water_networks_operation_area_id_foreign');
            $table->dropForeign('water_networks_operator_id_foreign');
            $table->dropColumn(['operation_area_id', 'operator_id']);
            $table->foreignIdFor(\App\Models\District::class)->nullable()->constrained();
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
