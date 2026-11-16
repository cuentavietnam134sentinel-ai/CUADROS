<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('dimensions'); // e.g. "80x120 cm"
            $table->string('materials')->nullable(); // e.g. "Resina epoxi, pigmentos nacarados, bastidor de madera"
            $table->enum('type', ['unique', 'limited_series', 'made_to_order'])->default('unique');
            $table->string('making_time')->nullable(); // e.g. "10-15 días"
            $table->integer('stock')->default(1);
            $table->enum('status', ['available', 'sold', 'made_to_order'])->default('available');
            $table->boolean('featured')->default(false);
            $table->string('image')->nullable();
            $table->text('care_instructions')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
