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
        Schema::create('potensis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('kategori', ['pertanian', 'peternakan', 'umkm', 'wisata', 'sumber_daya_alam']);
            $table->text('deskripsi');
            $table->text('detail');
            $table->string('gambar')->nullable();
            $table->string('kontak');
            $table->string('telepon');
            $table->string('lokasi');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('potensis');
    }
};
