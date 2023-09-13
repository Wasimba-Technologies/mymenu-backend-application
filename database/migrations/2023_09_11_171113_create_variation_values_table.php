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
        Schema::create('variation_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variation_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->boolean('is_incrementing')->default(false);
            $table->string('type')->default('radio');
            $table->double('price', 12);
            $table->string('tenant_id', 32)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variation_values');
    }
};
