@extends('admin.layouts.app')

@section('title', 'Pengaturan Sekolah')

@section('page-title', 'Pengaturan Sekolah')
@section('page-subtitle', 'Kelola Visi, Misi, dan Logo Sekolah')

@section('content')
<div class="container">
    <div class="header">
        <h1>⚙️ Pengaturan Sekolah</h1>
        <p>Ubah visi, misi, dan logo sekolah yang ditampilkan di halaman user</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.school-settings.update') }}" enctype="multipart/form-data" class="form">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="school_name">Nama Sekolah *</label>
            <div class="input-wrapper">
                <i class="fas fa-school input-icon"></i>
                <input type="text"
                       id="school_name"
                       name="school_name"
                       value="{{ old('school_name', $settings->school_name) }}"
                       required
                       class="form-control"
                       placeholder="Masukkan nama sekolah">
            </div>
        </div>

        <div class="form-group">
            <label for="school_address">Alamat Sekolah *</label>
            <div class="input-wrapper">
                <i class="fas fa-map-marker-alt input-icon" style="top: 16px;"></i>
                <textarea id="school_address"
                          name="school_address"
                          rows="3"
                          required
                          class="form-control"
                          placeholder="Masukkan alamat lengkap sekolah">{{ old('school_address', $settings->school_address) }}</textarea>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="school_phone">Telepon Sekolah *</label>
                <div class="input-wrapper">
                    <i class="fas fa-phone input-icon"></i>
                    <input type="text"
                           id="school_phone"
                           name="school_phone"
                           value="{{ old('school_phone', $settings->school_phone) }}"
                           required
                           class="form-control"
                           placeholder="Contoh: (0251) 7547381">
                </div>
            </div>

            <div class="form-group">
                <label for="school_email">Email Sekolah *</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email"
                           id="school_email"
                           name="school_email"
                           value="{{ old('school_email', $settings->school_email) }}"
                           required
                           class="form-control"
                           placeholder="Contoh: smkn4@smkn4bogor.sch.id">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="home_description">Deskripsi Beranda *</label>
            <div class="input-wrapper">
                <i class="fas fa-align-left input-icon" style="top: 16px;"></i>
                <textarea id="home_description" 
                          name="home_description" 
                          rows="4" 
                          required 
                          class="form-control"
                          placeholder="Masukkan deskripsi yang akan ditampilkan di halaman beranda user">{{ old('home_description', $settings->home_description) }}</textarea>
            </div>
            <small class="form-text">Deskripsi ini akan ditampilkan di hero section halaman beranda</small>
        </div>

        <div class="form-group">
            <label for="vision">Visi Sekolah *</label>
            <div class="input-wrapper">
                <i class="fas fa-eye input-icon" style="top: 16px;"></i>
                <textarea id="vision" 
                          name="vision" 
                          rows="4" 
                          required 
                          class="form-control"
                          placeholder="Masukkan visi sekolah">{{ old('vision', $settings->vision) }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="mission">Misi Sekolah *</label>
            <div class="input-wrapper">
                <i class="fas fa-bullseye input-icon" style="top: 16px;"></i>
                <textarea id="mission" 
                          name="mission" 
                          rows="6" 
                          required 
                          class="form-control"
                          placeholder="Masukkan misi sekolah (pisahkan dengan baris baru untuk setiap poin)">{{ old('mission', $settings->mission) }}</textarea>
            </div>
            <small class="form-text">Pisahkan setiap poin misi dengan baris baru (Enter)</small>
        </div>

        <div class="form-group">
            <label for="logo">Logo Sekolah</label>
            <div style="margin-bottom: 16px;">
                @if($settings->logo_path)
                    <div style="margin-bottom: 12px;">
                        <p style="font-size: 14px; color: #64748b; margin-bottom: 8px;">Logo Saat Ini:</p>
                        <img src="{{ asset($settings->logo_path) }}" 
                             alt="Logo Sekolah" 
                             style="max-width: 200px; max-height: 100px; border: 1px solid #e2e8f0; border-radius: 8px; padding: 8px; background: white;"
                             onerror="this.style.display='none';">
                    </div>
                @endif
                <div class="input-wrapper">
                    <i class="fas fa-image input-icon"></i>
                    <input type="file" 
                           id="logo" 
                           name="logo" 
                           accept="image/*"
                           class="form-control">
                </div>
            </div>
            <small class="form-text">Format: JPG, PNG, GIF, SVG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah logo.</small>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">
                <i class="fas fa-times"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<style>
    .container {
        max-width: 900px;
        margin: 0 auto;
    }

    .header {
        margin-bottom: 32px;
    }

    .header h1 {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .header p {
        font-size: 14px;
        color: #64748b;
    }

    .form {
        background: white;
        padding: 32px;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 16px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 16px;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px 12px 48px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.2s;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    textarea.form-control {
        padding-left: 48px;
        resize: vertical;
    }

    input[type="file"].form-control {
        padding: 8px 16px 8px 48px;
    }

    .form-text {
        display: block;
        font-size: 12px;
        color: #6b7280;
        margin-top: 6px;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid #e2e8f0;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-outline {
        background: white;
        color: #374151;
        border: 1px solid #e2e8f0;
    }

    .btn-outline:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }

    .alert {
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 24px;
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #6ee7b7;
    }

    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fca5a5;
    }

    .alert ul {
        margin: 8px 0 0 0;
        padding-left: 20px;
    }
</style>
@endsection

