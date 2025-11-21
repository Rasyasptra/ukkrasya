<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{ 
    public function up(): void
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();


            
        
            $table->string('filename');
            $table->string('file_path');
            $table->string('category')->default('general');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
