<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropColumn('meter_id');
            $table->dropColumn('pipe_cross');
            $table->string('meter_number')->nullable();
            $table->integer('meter_qty')->nullable();
            $table->string('upi')->nullable();
            $table->date('ebm_date')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->dateTime('approval_date')->nullable();
            $table->string('status')->default('Pending');

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('approved_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropForeign(['requests_approved_by_foreign']);
            $table->dropForeign(['requests_created_by_foreign']);
            $table->dropColumn('meter_number');
            $table->dropColumn('meter_qty');
            $table->dropColumn('upi');
            $table->dropColumn('ebm_date');
            $table->dropColumn('created_by');
            $table->dropColumn('approved_by');
            $table->dropColumn('approval_date');
            $table->dropColumn('status');
            $table->string('meter_id')->nullable();
            $table->string('pipe_cross')->nullable();
        });
    }
}
