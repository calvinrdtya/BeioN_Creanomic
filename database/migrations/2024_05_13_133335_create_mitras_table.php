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
        Schema::create('mitras', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('owner')->nullable();
            $table->json('identitas')->nullable();
            $table->string('pic')->nullable();
            $table->string('jabatan')->nullable();
            $table->json('legal')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('kota')->nullable();
            $table->string('alamat')->nullable();
            $table->enum('role', ['mitra']);
            $table->enum('jenis', ['transportasi motor', 'transportasi mobil','perjalanan', 'homestay', 'perlengkapan']);
            $table->integer('status')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('google_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitras');
    }
};
