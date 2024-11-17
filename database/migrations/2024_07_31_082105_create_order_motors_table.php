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
        Schema::create('order_motors', function (Blueprint $table) {
            $table->id();
            $table->string('uniq_motor')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('mitra_id')->nullable()->constrained('mitras')->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->foreignId('motor_id')->nullable()->constrained('motors')->onDelete('cascade'); // Tetap terhubung ke tabel motors
            $table->decimal('subtotal', 12, 2)->nullable(); // Menggunakan decimal
            $table->string('coupon_code')->nullable();
            $table->integer('discount')->nullable();
            $table->decimal('grand_total', 12, 2)->nullable(); // Menggunakan decimal
            $table->enum('payment_status', [1, 2, 3, 4])->comment('1=Menunggu Pembayaran, 2=Pembayaran Berhasil, 3=Expired, 4=Dibatalkan');
            $table->string('order_type')->default('motor');
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('no_handphone');
            $table->string('email');
            $table->string('alamat_lengkap');
            $table->date('tgl_pinjam')->nullable();
            $table->date('tgl_pengembalian')->nullable();
            $table->string('durasi_pinjam')->nullable();
            $table->text('snap_token')->nullable(); // Menggunakan text
            $table->string('cod')->nullable();
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
        Schema::dropIfExists('order_motors');
    }
};
