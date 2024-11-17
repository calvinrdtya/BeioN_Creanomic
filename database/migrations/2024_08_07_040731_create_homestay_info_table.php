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
        Schema::create('homestay_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id')->nullable()->constrained('mitras')->onDelete('cascade');
            $table->foreignId('homestay_id')->nullable()->constrained('homestays')->onDelete('cascade');
            $table->string('uniq_id')->unique();
            $table->text('important_information')->nullable();
            $table->text('kebijakan_refund')->nullable();
            $table->text('kebijakan_reschedule')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homestay_info');
    }
};
