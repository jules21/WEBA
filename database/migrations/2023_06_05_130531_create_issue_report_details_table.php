<?php

use App\Models\IssueReport;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueReportDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_report_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(IssueReport::class)->constrained();
            $table->unsignedBigInteger('user_id');
            $table->string('user_type');
            $table->longText('description');
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
        Schema::dropIfExists('issue_report_details');
    }
}
