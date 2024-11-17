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
        Schema::create('transportasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id')->nullable()->constrained('mitras')->onDelete('cascade');
            $table->string('title');           
            $table->enum('jenis', ['Manual', 'Matic']);
            $table->longText('deskripsi');
            $table->longText('alamat');
            $table->integer('qty');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->string('price');
            $table->string('final_price')->nullable();
            $table->integer('price_discount')->nullable();
            $table->enum('bbm', ['0', '1'])->nullable();
            $table->enum('layanan', ['Sopir', 'Lepas Kunci', 'Semua'])->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportasis');
    }
};
