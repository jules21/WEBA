<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForAdminToUserManualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_manuals', function (Blueprint $table) {
            $table->boolean('for_admin')->default(false)
                    ->comment('0: for user, 1: for admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_manuals', function (Blueprint $table) {
            $table->dropColumn('for_admin');
        });
    }
}
