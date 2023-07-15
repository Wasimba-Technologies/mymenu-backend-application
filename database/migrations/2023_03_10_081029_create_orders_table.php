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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('table_id')->constrained('id')->on('tables');
            $table->foreignId('customer_id')->constrained('id')->on('customers');
            $table->string('tenant_id', 32)->nullable();
            $table->string('status')->default('Pending');
            $table->decimal('sub_total')->nullable();
            $table->unsignedInteger('discount')->default(0);
            $table->unsignedInteger('tax')->default(0);
            $table->decimal('shipping')->default(0.0);
            $table->unsignedInteger('grand_total')->nullable();
            $table->unsignedInteger('preparation_time')->nullable();
            $table->string('deliver_method')->default('dine in'); //dine in or take away
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
