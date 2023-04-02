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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->ulid('id')->primary()->unique();
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('address_one');
            $table->string('address_two');
            $table->string('country');
            $table->string('currency',3);
            $table->foreignId('plan_id')->constrained();
            $table->string('logo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
