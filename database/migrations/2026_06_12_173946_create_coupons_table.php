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
        Schema::create('coupons', function (Blueprint $table) {
           $table->id();
           $table->foreignId('store_id')->constrained()->onDelete('cascade');
$table->string('external_id')->unique()->nullable();
$table->string('title');
$table->string('code');
$table->string('discount_value')->nullable();
$table->date('expires_at')->nullable();
 $table->boolean('is_active')->default(true);
$table->timestamps();
$table->index('code');
$table->index('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
