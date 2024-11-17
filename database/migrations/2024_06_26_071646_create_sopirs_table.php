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
        Schema::create('sopirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id')->nullable()->constrained('mitras')->onDelete('cascade');
            $table->string('name');
            $table->string('foto')->nullable();
            $table->string('ktp');
            $table->string('sim');
            $table->longText('alamat');
            $table->integer('usia');
            $table->enum('status', [0, 1])->comment('1=Available, 0=No Available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sopirs');
    }
};
