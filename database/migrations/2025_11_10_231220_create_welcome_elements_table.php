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
        Schema::create('welcome_elements', function (Blueprint $table) {
            $table->id();
            $table->string('element_type'); // navbar, hero, profile, location, agriculture, culture, footer
            $table->string('element_key'); // unique key within type (e.g., 'title', 'description', 'image')
            $table->text('content'); // the actual content
            $table->integer('sort_order')->default(0); // for ordering elements
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('welcome_elements');
    }
};
