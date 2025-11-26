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
        Schema::table('school_settings', function (Blueprint $table) {
            $table->string('school_name')->nullable()->after('id');
            $table->text('school_address')->nullable()->after('school_name');
            $table->string('school_phone', 30)->nullable()->after('mission');
            $table->string('school_email')->nullable()->after('school_phone');
        });

        // Ensure there is at least one settings row with default values
        $settings = DB::table('school_settings')->first();

        if (!$settings) {
            DB::table('school_settings')->insert([
                'vision' => 'Menjadi sekolah yang tangguh dalam IMTAQ, cerdas, terampil, mandiri, berbasis Teknologi Informasi dan Komunikasi, dan berwawasan lingkungan.',
                'mission' => "Menumbuhkan sikap agama dan spiritualitas\nMengembangkan literasi sesuai kompetensi siswa\nMeningkatkan keterampilan kompetensi sesuai jurusan",
                'logo_path' => 'logo.png',
                'school_name' => 'SMK Negeri 4 Bogor',
                'school_address' => 'Kp. Buntar, Kelurahan Muarasari, Bogor Selatan, Kota Bogor',
                'school_phone' => '(0251) 7547381',
                'school_email' => 'smkn4@smkn4bogor.sch.id',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $updates = [];

            if (is_null($settings->school_name)) {
                $updates['school_name'] = 'SMK Negeri 4 Bogor';
            }

            if (is_null($settings->school_address)) {
                $updates['school_address'] = 'Kp. Buntar, Kelurahan Muarasari, Bogor Selatan, Kota Bogor';
            }

            if (is_null($settings->school_phone)) {
                $updates['school_phone'] = '(0251) 7547381';
            }

            if (is_null($settings->school_email)) {
                $updates['school_email'] = 'smkn4@smkn4bogor.sch.id';
            }

            if (!empty($updates)) {
                $updates['updated_at'] = now();
                DB::table('school_settings')->where('id', $settings->id)->update($updates);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_settings', function (Blueprint $table) {
            $table->dropColumn([
                'school_name',
                'school_address',
                'school_phone',
                'school_email',
            ]);
        });
    }
};
