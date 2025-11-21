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
        // Add user_id to likes table
        Schema::table('likes', function (Blueprint $table) {
            // Drop existing unique constraint first
            $table->dropUnique(['photo_id', 'ip_address']);
            
            // Add user_id column
            $table->foreignId('user_id')->nullable()->after('photo_id')->constrained('users')->onDelete('cascade');
            
            // Add new unique constraint for logged-in users
            $table->unique(['photo_id', 'user_id'], 'likes_photo_user_unique');
        });

        // Add user_id to comments table
        Schema::table('comments', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('photo_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropUnique('likes_photo_user_unique');
            $table->dropColumn('user_id');
            
            // Restore original unique constraint
            $table->unique(['photo_id', 'ip_address']);
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
