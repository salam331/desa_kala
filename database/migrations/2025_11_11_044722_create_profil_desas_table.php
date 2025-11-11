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
        Schema::create('profil_desas', function (Blueprint $table) {
            $table->id();
            $table->text('sejarah_desa');
            $table->text('visi');
            $table->text('misi');
            $table->json('data_wilayah'); // luas_wilayah, batas_utara, batas_selatan, batas_timur, batas_barat, jumlah_dusun, jumlah_rt, jumlah_rw
            $table->string('peta_embed')->nullable(); // iframe embed untuk peta
            $table->decimal('latitude', 10, 8)->nullable(); // koordinat untuk peta
            $table->decimal('longitude', 11, 8)->nullable(); // koordinat untuk peta
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_desas');
    }
};
