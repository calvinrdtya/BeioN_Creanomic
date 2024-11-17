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
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id')->nullable()->constrained('mitras')->onDelete('cascade');
            $table->string('title')->nullable();           
            $table->enum('jenis', ['Manual', 'Matic']);
            $table->longText('deskripsi')->nullable();
            $table->longText('alamat')->nullable();
            $table->integer('qty')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->string('price')->nullable();
            $table->string('final_price')->nullable();
            $table->integer('price_discount')->nullable();
            $table->string('image')->nullable();
            $table->enum('bbm', ['0', '1'])->nullable();
            $table->enum('layanan', ['Sopir', 'Lepas Kunci', 'Semua'])->nullable();
            $table->enum('status', [1, 2])->default(1)->comment('1=Publish, 2=Hide');
            $table->string('kota')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};
