<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('website_page_sections', function (Blueprint $table) {
            $table->renameColumn('content_id', 'page_id');
        });
    }

    public function down(): void
    {
        Schema::table('website_page_sections', function (Blueprint $table) {
            $table->renameColumn('page_id', 'content_id');
        });
    }
};