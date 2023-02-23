<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveContactPersonToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'contact_person_name',
                'contact_person_phone',
                'contact_person_email',
            ]);

            $table->dropForeign('users_operation_area_foreign');
            $table->dropColumn('operation_area');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_phone')->nullable();
            $table->string('contact_person_email')->nullable();

            $table->unsignedBigInteger('operation_area')->nullable();
            $table->foreign('operation_area')
                ->references('id')
                ->on('districts');
        });
    }
}
