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
        Schema::create('pencairan_perlengkapans', function (Blueprint $table) {
            $table->id();
            $table->string('uniq_perlengkapan')->nullable();
            $table->foreignId('mitra_id')->nullable()->constrained('mitras')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->foreignId('perlengkapan_id')->nullable()->constrained('perlengkapans')->onDelete('cascade');
            $table->decimal('subtotal', 12, 2)->nullable();
            $table->string('coupon_code')->nullable();
            $table->integer('discount')->nullable();
            $table->decimal('grand_total', 12, 2)->nullable();
            $table->string('payment_status')->default('Pembayaran Berhasil');
            $table->enum('pencairan_status', [1, 2, 3, 4])->comment('1=Pending, 2=Pencairan Berhasil, 3=Gagal, 4=Dibatalkan');
            $table->string('status_booking')->default('Selesai');
            $table->string('order_type')->default('perlengkapan');
            $table->string('image_bukti')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('no_handphone')->nullable();
            $table->string('email')->nullable();
            $table->string('alamat_lengkap')->nullable();
            $table->date('tgl_pinjam')->nullable();
            $table->date('tgl_pengembalian')->nullable();
            $table->string('durasi_pinjam')->nullable();
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
        Schema::dropIfExists('pencairan_perlengkapans');
    }
};
