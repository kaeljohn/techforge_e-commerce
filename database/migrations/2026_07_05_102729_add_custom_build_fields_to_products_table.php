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
        Schema::table('products', function (Blueprint $table) {
            $table->string('tag')->nullable();
            $table->string('os')->nullable();
            $table->string('cpu')->nullable();
            $table->string('gpu')->nullable();
            $table->string('ram')->nullable();
            $table->string('storage')->nullable();
            $table->integer('forge_points')->default(0);
            $table->string('shipping_status')->nullable();
            $table->string('promo_tag')->nullable();
            $table->decimal('original_price', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'tag', 'os', 'cpu', 'gpu', 'ram', 'storage', 
                'forge_points', 'shipping_status', 'promo_tag', 'original_price'
            ]);
        });
    }
};
