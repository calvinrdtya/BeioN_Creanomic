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
        Schema::create('order_homestays', function (Blueprint $table) {
            $table->id();
            $table->string('uniq_homestay')->nullable();;
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('mitra_id')->nullable()->constrained('mitras')->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->foreignId('homestay_id')->nullable()->constrained('homestays')->onDelete('cascade');
            $table->decimal('subtotal', 12, 2)->nullable(); // Menggunakan decimal
            $table->string('coupon_code')->nullable();
            $table->integer('discount')->nullable();
            $table->decimal('grand_total', 12, 2)->nullable(); // Menggunakan decimal
            $table->enum('payment_status', [1, 2, 3, 4])->comment('1=Waiting Payment, 2=Payment Successful, 3=Expired, 4=Canceled');
            $table->string('order_type')->default('homestay');
            $table->enum('status_booking', [1, 2, 3])->comment('1=Booking, 2=Selesai, 3=Cancel');
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
        Schema::dropIfExists('order_homestays');
    }
};