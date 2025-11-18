<?php

namespace App\Tools;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DataValidator
{
    /**
     * Validate photo data
     */
    public function validatePhotoData(array $data): array
    {
        $rules = [
            'title' => 'required|string|max:255|min:3',
            'description' => 'nullable|string|max:1000',
            'category' => [
                'required',
                'string',
                Rule::in(array_keys(\App\Helpers\CategoryHelper::getCategories()))
            ],
            'file' => 'required|file|image|mimes:jpeg,png,gif,webp,svg|max:5120', // 5MB
            'uploaded_by' => 'required|integer|exists:users,id'
        ];

        $messages = [
            'title.required' => 'Judul foto harus diisi.',
            'title.min' => 'Judul foto minimal 3 karakter.',
            'title.max' => 'Judul foto maksimal 255 karakter.',
            'description.max' => 'Deskripsi maksimal 1000 karakter.',
            'category.required' => 'Kategori harus dipilih.',
            'category.in' => 'Kategori tidak valid.',
            'file.required' => 'File foto harus diupload.',
            'file.image' => 'File harus berupa gambar.',
            'file.mimes' => 'Format file harus JPEG, PNG, GIF, WebP, atau SVG.',
            'file.max' => 'Ukuran file maksimal 5MB.',
            'uploaded_by.required' => 'User ID harus diisi.',
            'uploaded_by.exists' => 'User tidak ditemukan.'
        ];

        $validator = Validator::make($data, $rules, $messages);
        
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        return $validator->validated();
    }

    /**
     * Validate information data
     */
    public function validateInformationData(array $data): array
    {
        $rules = [
            'title' => 'required|string|max:255|min:5',
            'content' => 'required|string|min:10',
            'type' => [
                'required',
                'string',
                Rule::in(['announcement', 'news', 'event', 'general'])
            ],
            'priority' => [
                'required',
                'string',
                Rule::in(['urgent', 'high', 'medium', 'low'])
            ],
            'is_published' => 'boolean',
            'published_at' => 'nullable|date|after_or_equal:today',
            'expires_at' => 'nullable|date|after:published_at',
            'created_by' => 'required|integer|exists:users,id'
        ];

        $messages = [
            'title.required' => 'Judul informasi harus diisi.',
            'title.min' => 'Judul informasi minimal 5 karakter.',
            'title.max' => 'Judul informasi maksimal 255 karakter.',
            'content.required' => 'Konten informasi harus diisi.',
            'content.min' => 'Konten informasi minimal 10 karakter.',
            'type.required' => 'Tipe informasi harus dipilih.',
            'type.in' => 'Tipe informasi tidak valid.',
            'priority.required' => 'Prioritas harus dipilih.',
            'priority.in' => 'Prioritas tidak valid.',
            'published_at.date' => 'Tanggal publikasi tidak valid.',
            'published_at.after_or_equal' => 'Tanggal publikasi tidak boleh di masa lalu.',
            'expires_at.date' => 'Tanggal kadaluarsa tidak valid.',
            'expires_at.after' => 'Tanggal kadaluarsa harus setelah tanggal publikasi.',
            'created_by.required' => 'User ID harus diisi.',
            'created_by.exists' => 'User tidak ditemukan.'
        ];

        $validator = Validator::make($data, $rules, $messages);
        
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        return $validator->validated();
    }

    /**
     * Validate user registration data
     */
    public function validateUserRegistrationData(array $data): array
    {
        $rules = [
            'name' => 'required|string|max:255|min:2',
            'username' => 'required|string|min:3|max:50|unique:users,username|regex:/^[a-zA-Z0-9_]+$/',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8'
        ];

        $messages = [
            'name.required' => 'Nama lengkap harus diisi.',
            'name.min' => 'Nama lengkap minimal 2 karakter.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',
            'username.required' => 'Username harus diisi.',
            'username.min' => 'Username minimal 3 karakter.',
            'username.max' => 'Username maksimal 50 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'username.regex' => 'Username hanya boleh mengandung huruf, angka, dan underscore.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password_confirmation.required' => 'Konfirmasi password harus diisi.'
        ];

        $validator = Validator::make($data, $rules, $messages);
        
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        return $validator->validated();
    }

    /**
     * Validate user login data
     */
    public function validateUserLoginData(array $data): array
    {
        $rules = [
            'username' => 'required|string',
            'password' => 'required|string'
        ];

        $messages = [
            'username.required' => 'Username harus diisi.',
            'password.required' => 'Password harus diisi.'
        ];

        $validator = Validator::make($data, $rules, $messages);
        
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        return $validator->validated();
    }

    /**
     * Sanitize string input
     */
    public function sanitizeString(string $input): string
    {
        // Remove HTML tags
        $sanitized = strip_tags($input);
        
        // Trim whitespace
        $sanitized = trim($sanitized);
        
        // Remove extra spaces
        $sanitized = preg_replace('/\s+/', ' ', $sanitized);
        
        return $sanitized;
    }

    /**
     * Sanitize HTML content
     */
    public function sanitizeHtml(string $input): string
    {
        // Allow only safe HTML tags
        $allowedTags = '<p><br><strong><em><u><ul><ol><li><h1><h2><h3><h4><h5><h6>';
        
        $sanitized = strip_tags($input, $allowedTags);
        
        // Clean up attributes
        $sanitized = preg_replace('/<(\w+)[^>]*>/', '<$1>', $sanitized);
        
        return $sanitized;
    }

    /**
     * Validate search query
     */
    public function validateSearchQuery(string $query): string
    {
        // Remove special characters except spaces and basic punctuation
        $sanitized = preg_replace('/[^\w\s\-\.]/', '', $query);
        
        // Trim and limit length
        $sanitized = trim($sanitized);
        $sanitized = substr($sanitized, 0, 100);
        
        return $sanitized;
    }

    /**
     * Validate pagination parameters
     */
    public function validatePaginationParams(array $params): array
    {
        $rules = [
            'page' => 'integer|min:1',
            'per_page' => 'integer|min:1|max:100',
            'sort' => 'string|in:created_at,updated_at,title,name',
            'order' => 'string|in:asc,desc'
        ];

        $validator = Validator::make($params, $rules);
        
        if ($validator->fails()) {
            // Return default values if validation fails
            return [
                'page' => 1,
                'per_page' => 12,
                'sort' => 'created_at',
                'order' => 'desc'
            ];
        }

        $validated = $validator->validated();
        
        return [
            'page' => $validated['page'] ?? 1,
            'per_page' => $validated['per_page'] ?? 12,
            'sort' => $validated['sort'] ?? 'created_at',
            'order' => $validated['order'] ?? 'desc'
        ];
    }

    /**
     * Validate file upload parameters
     */
    public function validateFileUploadParams(array $params): array
    {
        $rules = [
            'category' => [
                'required',
                'string',
                Rule::in(array_keys(\App\Helpers\CategoryHelper::getCategories()))
            ],
            'max_size' => 'integer|min:1024|max:10240', // 1KB to 10MB
            'allowed_types' => 'array',
            'allowed_types.*' => 'string|in:jpeg,png,gif,webp,svg'
        ];

        $validator = Validator::make($params, $rules);
        
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        return $validator->validated();
    }

    /**
     * Check if user has permission for action
     */
    public function validateUserPermission(string $action, $user = null): bool
    {
        $user = $user ?? auth()->user();
        
        if (!$user) {
            return false;
        }

        $permissions = [
            'create_photo' => ['admin', 'user'],
            'edit_photo' => ['admin'],
            'delete_photo' => ['admin'],
            'create_information' => ['admin'],
            'edit_information' => ['admin'],
            'delete_information' => ['admin'],
            'publish_information' => ['admin'],
            'view_admin_dashboard' => ['admin'],
            'view_user_dashboard' => ['admin', 'user']
        ];

        if (!isset($permissions[$action])) {
            return false;
        }

        return in_array($user->role, $permissions[$action]);
    }

    /**
     * Validate date range
     */
    public function validateDateRange(array $data): array
    {
        $rules = [
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date'
        ];

        $messages = [
            'start_date.date' => 'Tanggal mulai tidak valid.',
            'end_date.date' => 'Tanggal akhir tidak valid.',
            'end_date.after_or_equal' => 'Tanggal akhir harus setelah atau sama dengan tanggal mulai.'
        ];

        $validator = Validator::make($data, $rules, $messages);
        
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        return $validator->validated();
    }
}

