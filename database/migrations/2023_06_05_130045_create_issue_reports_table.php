<?php

use App\Models\Client;
use App\Models\District;
use App\Models\OperationArea;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['CUSTOMER', 'OPERATOR']);
            $table->foreignIdFor(Client::class)->nullable()->constrained();
            $table->foreignIdFor(OperationArea::class)->nullable()->constrained();
            $table->foreignIdFor(User::class)->nullable()->constrained();
            $table->foreignIdFor(District::class)->nullable()->constrained();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('issue_reports');
    }
}
