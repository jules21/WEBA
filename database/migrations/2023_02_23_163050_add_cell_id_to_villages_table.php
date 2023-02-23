<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCellIdToVillagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('villages', function (Blueprint $table) {
            // delete sector foreign key
            $table->dropForeign('villages_sector_id_foreign');
            $table->dropColumn('sector_id');

            $table->foreignId('cell_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('villages', function (Blueprint $table) {
            $table->dropForeign('villages_cell_id_foreign');
            $table->dropColumn('cell_id');

            $table->foreignId('sector_id')->constrained()->onDelete('cascade');
        });
    }
}
