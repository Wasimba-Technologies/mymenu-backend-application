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
        //Add columns to the menu_items table
        Schema::table('menu_items', function (Blueprint $table) {
            $table->json('ingredients')->nullable();
            $table->json('addons')->nullable();
            $table->json('variations')->nullable();
            $table->json('allergens')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Drop columns from the menu_items table
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn('ingredients');
            $table->dropColumn('addons');
            $table->dropColumn('variations');
            $table->dropColumn('allergens');
        });
    }
};
