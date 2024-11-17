<?php

use App\Models\Mitra;
use App\Models\User;
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
        Schema::create('history_ecotourisms', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->unique();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Mitra::class);
            $table->string('image');
            $table->string('title');
            $table->decimal('qty', 12, 2);
            $table->integer('point');
            $table->enum('status', [0, 1, 2])->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_ecotourisms');
    }
};
