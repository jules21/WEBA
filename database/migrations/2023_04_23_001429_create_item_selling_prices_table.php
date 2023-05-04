<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemSellingPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_selling_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->foreignId('operation_area_id')->constrained('operation_areas')->onDelete('cascade');
            $table->foreignId('stock_movement_id')->constrained('stock_movements')->onDelete('cascade');
            $table->decimal('price', 18, 2);
            $table->integer('quantity')->unsigned();
            $table->foreignId('parent_movement_id')->nullable()->constrained('stock_movements')->onDelete('cascade');
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->onDelete('cascade');
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
        Schema::dropIfExists('item_selling_prices');
    }
}
