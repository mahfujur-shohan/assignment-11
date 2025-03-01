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
        $table->string('category');
        $table->decimal('price', 8, 2);
        $table->text('short_description');
        $table->text('long_description');
        $table->string('image')->nullable();
        $table->integer('stock');
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->text('seo_tags')->nullable();
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
