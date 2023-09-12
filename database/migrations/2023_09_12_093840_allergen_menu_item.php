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
        Schema::create('allergen_menu_item', function (Blueprint $table) {
            $table->foreign('allergen_id')->references('id')->on('allergens');
            $table->foreign('menu_item_id')->references('id')->on('menu_items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allergen_menu_item');
    }
};
