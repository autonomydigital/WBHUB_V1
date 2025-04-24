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
        Schema::create('user_connections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // The one sending the request
            $table->unsignedBigInteger('connected_user_id'); // The one receiving it
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        
            $table->unique(['user_id', 'connected_user_id']);
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('connected_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_connections');
    }
};
