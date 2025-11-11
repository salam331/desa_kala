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
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('kategori', ['administrasi', 'perizinan']);
            $table->text('deskripsi');
            $table->json('prosedur'); // Array of procedure steps
            $table->json('syarat'); // Array of requirements
            $table->string('waktu_proses');
            $table->string('biaya');
            $table->string('kontak');
            $table->string('gambar')->nullable(); // Optional image
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};
