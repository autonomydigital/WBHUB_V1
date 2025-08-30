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
            $table->foreignId('website_content_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['text', 'image']);
            $table->string('title')->nullable(); // Superadmin-defined title
            $table->text('content')->nullable(); // For text sections
            $table->string('url')->nullable();   // For image sections
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
