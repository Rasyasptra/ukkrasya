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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // comment, like, user_register
            $table->text('message');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // user yang melakukan aksi
            $table->foreignId('photo_id')->nullable()->constrained()->onDelete('cascade'); // foto terkait
            $table->foreignId('comment_id')->nullable()->constrained()->onDelete('cascade'); // komentar terkait
            $table->boolean('is_read')->default(false);
            $table->string('url')->nullable(); // link ke detail
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
