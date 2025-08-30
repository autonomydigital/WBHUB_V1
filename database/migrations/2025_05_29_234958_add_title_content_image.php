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
        Schema::create('website_page_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_content_id')->constrained()->onDelete('cascade');
            $table->string('title')->nullable(); // Superadmin-defined
            $table->string('url');
            $table->integer('order')->default(0);
            $table->timestamps();
        });    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
