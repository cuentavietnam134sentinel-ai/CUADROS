<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('dimensions');
            $table->string('color_palette');
            $table->string('finish');
            $table->text('description');
            $table->decimal('budget', 10, 2)->nullable();
            $table->string('status')->default('received'); // received, under_review, quoted, accepted, in_progress, finished, cancelled
            $table->decimal('quote_price', 10, 2)->nullable();
            $table->string('quote_making_time')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_requests');
    }
};
