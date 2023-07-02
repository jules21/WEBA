<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToGracePeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grace_periods', function (Blueprint $table) {
            $table->string('attachment')->nullable();
            $table->string('comment')->nullable();
            $table->string('edit_comment')->nullable();
            $table->date('star_date')->nullable();
            $table->date('end_date')->nullable();
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
