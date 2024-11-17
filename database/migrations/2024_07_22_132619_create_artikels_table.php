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
        Schema::create('artikels', function (Blueprint $table) {
            $table->string('id', 12)->primary();
            $table->unsignedBigInteger('category_admin_id')->default(1); // Menambahkan default value
            $table->foreign('category_admin_id')->references('id')->on('categories_admins')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('thumbnails')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('tag')->nullable();
            $table->enum('status', [0, 1])->comment('1=Publish, 0=Hide');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};
