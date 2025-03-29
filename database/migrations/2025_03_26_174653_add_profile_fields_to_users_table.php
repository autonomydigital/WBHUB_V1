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
    Schema::table('users', function (Blueprint $table) {
        $table->string('suburb')->nullable();
        $table->string('state')->nullable();
        $table->string('postcode')->nullable();
        $table->text('bio')->nullable();
        
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['suburb', 'state', 'postcode', 'bio']);
    });
}
};
