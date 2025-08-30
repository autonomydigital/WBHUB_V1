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
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('website_layout')->nullable()->after('has_website');
        });
    }
    
    public function down()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropColumn('website_layout');
        });
    }
};
