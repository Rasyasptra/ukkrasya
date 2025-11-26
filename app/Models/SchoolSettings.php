<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolSettings extends Model
{
    protected $table = 'school_settings';
    
    protected $fillable = [
        'vision',
        'mission',
        'logo_path',
        'school_name',
        'school_address',
        'school_phone',
        'school_email',
        'home_description',
    ];
    
    /**
     * Get the first (and only) settings record
     */
    public static function getSettings()
    {
        $settings = self::first();
        
        if (!$settings) {
            // Create default settings if none exist
            $settings = self::create([
                'vision' => 'Menjadi sekolah yang tangguh dalam IMTAQ, cerdas, terampil, mandiri, berbasis Teknologi Informasi dan Komunikasi, dan berwawasan lingkungan.',
                'mission' => "Menumbuhkan sikap agama dan spiritualitas\nMengembangkan literasi sesuai kompetensi siswa\nMeningkatkan keterampilan kompetensi sesuai jurusan",
                'logo_path' => 'logo.png',
                'school_name' => 'SMK Negeri 4 Bogor',
                'school_address' => 'Kp. Buntar, Kelurahan Muarasari, Bogor Selatan, Kota Bogor',
                'school_phone' => '(0251) 7547381',
                'school_email' => 'smkn4@smkn4bogor.sch.id',
                'home_description' => 'Membangun generasi yang kompeten, berkarakter, dan siap menghadapi tantangan masa depan melalui pendidikan berkualitas dan teknologi terkini.',
            ]);
        }

        // Ensure fallback values when fields are null
        $settings->school_name = $settings->school_name ?? 'SMK Negeri 4 Bogor';
        $settings->school_address = $settings->school_address ?? 'Kp. Buntar, Kelurahan Muarasari, Bogor Selatan, Kota Bogor';
        $settings->school_phone = $settings->school_phone ?? '(0251) 7547381';
        $settings->school_email = $settings->school_email ?? 'smkn4@smkn4bogor.sch.id';
        $settings->home_description = $settings->home_description ?? 'Membangun generasi yang kompeten, berkarakter, dan siap menghadapi tantangan masa depan melalui pendidikan berkualitas dan teknologi terkini.';
        
        return $settings;
    }
}
