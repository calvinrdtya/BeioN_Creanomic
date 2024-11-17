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
        Schema::create('history_homestays', function (Blueprint $table) {
            $table->string('uniq_homestay')->nullable();;
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->foreignId('homestay_id')->nullable()->constrained('homestays')->onDelete('cascade');
            $table->decimal('subtotal', 12, 2)->nullable();
            $table->string('coupon_code')->nullable();
            $table->integer('discount')->nullable();
            $table->decimal('grand_total', 12, 2)->nullable();
            $table->string('payment_status')->default('Pembayaran Berhasil');
            $table->string('status_booking')->default('Selesai');
            $table->string('order_type')->default('homestay');
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('no_handphone')->nullable();
            $table->string('email')->nullable();
            $table->string('alamat_lengkap')->nullable();
            $table->date('tgl_booking')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->string('durasi_booking')->nullable();
            $table->text('snap_token')->nullable();
            $table->string('note')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_homestays');
    }
};
