<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatDocumentTypeLegalTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_mapping', function (Blueprint $table) {
            $table->foreignId('legal_type_id')->constrained();
            $table->foreignId('document_type_id')->constrained();
            $table->unique(['legal_type_id', 'document_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_mapping');
    }
}
