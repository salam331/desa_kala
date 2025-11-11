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
        Schema::create('welcome_contents', function (Blueprint $table) {
            $table->id();
            $table->string('village_name');
            $table->text('hero_title');
            $table->text('hero_description');
            $table->string('hero_button_text');
            $table->string('hero_button_link');
            $table->string('hero_background_image')->nullable();
            $table->text('profile_title');
            $table->text('profile_description');
            $table->text('location_title');
            $table->text('location_description');
            $table->text('agriculture_title');
            $table->text('agriculture_description');
            $table->text('culture_title');
            $table->text('culture_description');
            $table->text('footer_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('welcome_contents');
    }
};
