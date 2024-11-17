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
        Schema::create('bank_perlengkapans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mitra_id'); // Foreign key untuk mitra
            $table->string('bank');                 // Nama bank
            $table->string('no_rekening');          // Nomor rekening
            $table->string('nama_pemilik');         // Nama pemilik rekening
            $table->timestamps();

            // foreign key
            $table->foreign('mitra_id')->references('id')->on('mitras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_perlengkapans');
    }
};
