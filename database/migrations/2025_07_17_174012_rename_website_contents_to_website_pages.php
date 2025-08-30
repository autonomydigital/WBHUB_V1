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
    Schema::rename('website_contents', 'website_pages');
}

public function down()
{
    Schema::rename('website_pages', 'website_contents');
}
};
