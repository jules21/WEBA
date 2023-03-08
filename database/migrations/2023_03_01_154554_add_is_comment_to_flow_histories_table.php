<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsCommentToFlowHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flow_histories', function (Blueprint $table) {
            $table->boolean('is_comment')->default(false);
            $table->text('comment')->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flow_histories', function (Blueprint $table) {
            $table->dropColumn('is_comment');
        });
    }
}
