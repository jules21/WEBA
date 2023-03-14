<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operation_area_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('ledger_no');
            $table->string('ledger_description');
            $table->string('ledger_type');
            $table->bigInteger('parent_ledger_no')->nullable();
            $table->integer('level');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chart_accounts');
    }
}
