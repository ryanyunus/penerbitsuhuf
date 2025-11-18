<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
        $table->string('title');
        $table->string('slug')->unique();
        $table->string('author')->nullable();
        $table->string('isbn')->nullable();
        $table->integer('price')->nullable(); // harga dalam rupiah
        $table->string('cover')->nullable();  // path cover
        $table->text('description')->nullable();
        $table->boolean('is_featured')->default(false);
        $table->timestamp('published_at')->nullable();
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
