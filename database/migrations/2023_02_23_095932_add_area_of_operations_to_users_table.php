<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAreaOfOperationsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('operation_area')->nullable()->constrained('area_of_operations');
            $table->boolean('is_super_admin')->default(false);
            $table->string('phone')->nullable()->after('email');
            $table->string('status')->default('active')->after('password');
            $table->dateTime('password_changed_at')->nullable()->after('password');
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
            $table->dropForeign('users_operation_area_foreign');
            $table->dropColumn('operation_area');
            $table->dropColumn('is_super_admin');
            $table->dropColumn('phone');
            $table->dropColumn('status');
            $table->dropColumn('password_changed_at');
        });
    }
}
