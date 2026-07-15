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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->nullable();
            $table->string('brand')->nullable();
            $table->string('processor')->nullable();
            $table->text('specs')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('rating', 3, 2)->nullable();
            $table->string('image_url')->nullable();
            $table->string('badge')->nullable();
            $table->boolean('is_sold_out')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
