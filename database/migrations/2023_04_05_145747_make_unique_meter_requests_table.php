<?php

use App\Models\MeterRequest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeUniqueMeterRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        MeterRequest::query()
            ->each(function ($query) {
                $query->update([
                    'meter_number' => strtoupper(uniqid("MT"))
                ]);
            });

        Schema::table('meter_requests', function (Blueprint $table) {
            $table->string('meter_number')->unique()->change();
            $table->bigInteger('last_index')->unsigned()->change();
            $table->dropUnique('meter_requests_request_id_meter_number_unique');
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
            $table->unique(['request_id', 'meter_number']);
            $table->dropUnique('meter_requests_meter_number_unique');
        });
    }
}
