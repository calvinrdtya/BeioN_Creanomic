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
        Schema::create('perlengkapans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id')->nullable()->constrained('mitras')->onDelete('cascade');
            $table->string('title');
            $table->integer('qty');
            $table->string('kota');
            $table->longText('deskripsi');
            $table->enum('status', [1 ,0]);
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->decimal('price', 12, 2)->nullable(); // Menggunakan decimal
            $table->decimal('final_price', 12, 2)->nullable(); // Menggunakan decimal
            $table->integer('price_discount')->nullable(); // Menggunakan decimal
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perlengkapans');
    }
};
