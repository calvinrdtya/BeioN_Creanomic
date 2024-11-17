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
        Schema::create('categories_admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_admin_id');
            $table->foreign('category_admin_id')->references('id')->on('categories_admins')->onDelete('cascade');
            $table->string('role')->default('admin');
            $table->enum('status', [0, 1])->default(1)->comment('1=Publish, 0=No Publish');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_admins');
    }
};
