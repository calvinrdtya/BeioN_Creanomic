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
        Schema::create('perjalanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id')->nullable()->constrained('mitras')->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->string('durasi');
            $table->string('fasilitas')->nullable();
            $table->date('tgl_perjalanan')->nullable();
            $table->string('titik')->nullable();
            $table->longText('deskripsi');
            $table->integer('qty');
            $table->enum('shipping_return', [1 ,0]);
            $table->enum('status', [1 ,0]);
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->string('price');
            $table->string('final_price')->nullable();
            $table->integer('price_discount')->nullable();
            $table->enum('featured', [1, 0]);
            $table->string('thumbnail')->nullable();
            $table->string('image')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perjalanans');
    }
};
