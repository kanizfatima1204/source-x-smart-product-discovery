<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category');
            $table->string('type');
            $table->string('location');
            $table->text('description');
            $table->decimal('price', 12, 2);
            $table->string('unit')->default('kg');
            $table->unsignedInteger('stock')->default(0);
            $table->decimal('rating', 2, 1)->default(0);
            $table->unsignedInteger('review_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->string('image')->nullable();
            $table->json('tags')->nullable();
            $table->string('source_name');
            $table->timestamps();
            $table->index(['category', 'location', 'price']);
        });
    }

    public function down(): void { Schema::dropIfExists('products'); }
};
