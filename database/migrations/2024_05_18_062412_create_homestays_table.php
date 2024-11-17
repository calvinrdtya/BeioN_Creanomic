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
        Schema::create('homestays', function (Blueprint $table) {
            $table->id();
            $table->string('uniq_id')->nullable();
            $table->foreignId('mitra_id')->nullable()->constrained('mitras')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('higlight')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->longText('alamat')->nullable();
            $table->integer('qty')->nullable();
            $table->enum('shipping_return', [1 ,0]);
            $table->enum('status', [1 ,0]);
            $table->decimal('price', 12, 2)->nullable();
            $table->decimal('final_price', 12, 2)->nullable();
            $table->integer('price_discount')->nullable();
            $table->decimal('rating', 2, 1)->nullable();
            $table->string('review')->nullable();
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
        Schema::dropIfExists('homestays');
    }
};
