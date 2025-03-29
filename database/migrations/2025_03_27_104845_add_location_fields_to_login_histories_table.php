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
        Schema::table('login_histories', function (Blueprint $table) {
            if (!Schema::hasColumn('login_histories', 'city')) {
                $table->string('city')->nullable();
            }
    
            if (!Schema::hasColumn('login_histories', 'country')) {
                $table->string('country')->nullable();
            }
    
            // Remove this if you already removed the old 'location' column
            // $table->dropColumn('location');
        });
    }

public function down()
{
    Schema::table('login_histories', function (Blueprint $table) {
        $table->dropColumn(['city', 'country']);
        $table->string('location')->nullable(); // Optional: restore if needed
    });
}
};
