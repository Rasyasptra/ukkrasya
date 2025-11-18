<?php

namespace App\Helpers;

class CategoryHelper
{
    /**
     * Get all available photo categories
     */
    public static function getCategories(): array
    {
        return [
            'ekstrakurikuler' => 'Ekstrakurikuler',
            'event' => 'Event dan Acara',
            'umum' => 'Umum',
            'akademik' => 'Akademik'
        ];
    }

    /**
     * Get category name by key
     */
    public static function getCategoryName(string $key): string
    {
        $categories = self::getCategories();
        return $categories[$key] ?? ucfirst($key);
    }

    /**
     * Get category key by name
     */
    public static function getCategoryKey(string $name): ?string
    {
        $categories = self::getCategories();
        return array_search($name, $categories) ?: null;
    }

    /**
     * Get categories for select options
     */
    public static function getSelectOptions(): array
    {
        $options = [];
        foreach (self::getCategories() as $key => $name) {
            $options[] = [
                'value' => $key,
                'label' => $name
            ];
        }
        return $options;
    }

    /**
     * Get categories grouped by main type
     */
    public static function getGroupedCategories(): array
    {
        return [
            'Aktivitas Sekolah' => [
                'kegiatan' => 'Kegiatan Sekolah',
                'ekstrakurikuler' => 'Ekstrakurikuler',
                'olahraga' => 'Olahraga & Kesehatan',
                'seni' => 'Seni & Budaya',
                'upacara' => 'Upacara & Acara Resmi'
            ],
            'SDM & Peserta Didik' => [
                'guru' => 'Guru & Staff',
                'siswa' => 'Siswa & Kegiatan Belajar',
                'prestasi' => 'Prestasi & Penghargaan'
            ],
            'Infrastruktur' => [
                'fasilitas' => 'Fasilitas & Infrastruktur',
                'teknologi' => 'Teknologi & Lab',
                'perpustakaan' => 'Perpustakaan'
            ],
            'Lainnya' => [
                'general' => 'Umum & Lainnya'
            ]
        ];
    }
}
