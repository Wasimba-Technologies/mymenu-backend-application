<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_menu_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('id')->on('orders');
            $table->foreignId('menu_item_id')->constrained('id')->on('menu_items');
            $table->json('ingredients')->nullable();
            $table->json('addons')->nullable();
            $table->json('variation_values')->nullable();
            $table->text('instructions')->nullable();
            //adds the price of the menu item at the time of order
            //because price cannot be cheaply traced back based on the added ingredients,addons,variations
            $table->unsignedDecimal('price', 12, 2);
            $table->unsignedInteger('qty');
            //$table->string('tenant_id', 32)->nullable();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
