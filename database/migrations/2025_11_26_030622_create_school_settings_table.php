<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('school_settings', function (Blueprint $table) {
            $table->id();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->string('logo_path')->nullable();
            $table->timestamps();
        });
        
        // Insert default values
        DB::table('school_settings')->insert([
            'vision' => 'Menjadi sekolah yang tangguh dalam IMTAQ, cerdas, terampil, mandiri, berbasis Teknologi Informasi dan Komunikasi, dan berwawasan lingkungan.',
            'mission' => 'Menumbuhkan sikap agama dan spiritualitas\nMengembangkan literasi sesuai kompetensi siswa\nMeningkatkan keterampilan kompetensi sesuai jurusan',
            'logo_path' => 'logo.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_settings');
    }
};
