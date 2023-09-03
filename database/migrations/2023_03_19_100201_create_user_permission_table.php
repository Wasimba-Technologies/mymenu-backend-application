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
        Schema::create('user_permission', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('permission_id')->constrained()->onDelete('CASCADE');
            //$table->string('tenant_id', 32)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_permission');
    }
};
