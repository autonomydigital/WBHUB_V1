<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::rename('website_page_sections', 'content_sections');
        Schema::rename('website_page_images', 'content_images');
    }
    
    public function down()
    {
        Schema::rename('content_sections', 'website_page_sections');
        Schema::rename('content_images', 'website_page_images');
    }
};
