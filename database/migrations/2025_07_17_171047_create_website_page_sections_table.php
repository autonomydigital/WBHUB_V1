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
        Schema::create('website_page_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('content_id');
            $table->integer('order')->default(0);
            $table->string('section_type'); // e.g., 'hero', 'why-sell', etc.
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->json('settings')->nullable();
            $table->timestamps();
        
            $table->foreign('content_id')->references('id')->on('website_contents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_page_sections');
    }
};
