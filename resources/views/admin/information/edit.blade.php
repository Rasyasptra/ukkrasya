@extends('admin.layouts.app')

@section('title', 'Edit Informasi')

@section('page-title', 'Manajemen Informasi')

@section('content')
<div class="container">
    <div class="header">
        <h1>✏️ Edit Informasi</h1>
        <p>Perbarui informasi yang sudah ada</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.information.update', $information->id) }}" class="form">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">Judul Informasi *</label>
            <div class="input-wrapper">
                <i class="fas fa-heading input-icon"></i>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title', $information->title) }}" 
                       required 
                       class="form-control"
                       placeholder="Masukkan judul informasi">
            </div>
        </div>

        <div class="form-group">
            <label for="type">Tipe Informasi *</label>
            <div class="input-wrapper">
                <i class="fas fa-tag input-icon"></i>
                <select id="type" name="type" required class="form-control">
                    <option value="">Pilih Tipe</option>
                    <option value="announcement" {{ old('type', $information->type) == 'announcement' ? 'selected' : '' }}>Pengumuman</option>
                    <option value="news" {{ old('type', $information->type) == 'news' ? 'selected' : '' }}>Berita</option>
                    <option value="event" {{ old('type', $information->type) == 'event' ? 'selected' : '' }}>Acara</option>
                    <option value="general" {{ old('type', $information->type) == 'general' ? 'selected' : '' }}>Umum</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="content">Konten Informasi *</label>
            <div class="input-wrapper">
                <i class="fas fa-align-left input-icon" style="top: 16px;"></i>
                <textarea id="content" 
                          name="content" 
                          rows="8" 
                          required 
                          class="form-control"
                          placeholder="Tulis konten informasi lengkap">{{ old('content', $information->content) }}</textarea>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="published_at">Tanggal Publikasi</label>
                <div class="input-wrapper">
                    <i class="fas fa-calendar-alt input-icon"></i>
                    <input type="datetime-local" 
                           id="published_at" 
                           name="published_at" 
                           value="{{ old('published_at', $information->published_at ? $information->published_at->format('Y-m-d\TH:i') : '') }}"
                           class="form-control">
                </div>
                <small class="form-text">Kosongkan untuk publikasi langsung</small>
            </div>

            <div class="form-group">
                <label for="expires_at">Tanggal Kadaluarsa</label>
                <div class="input-wrapper">
                    <i class="fas fa-calendar-times input-icon"></i>
                    <input type="datetime-local" 
                           id="expires_at" 
                           name="expires_at" 
                           value="{{ old('expires_at', $information->expires_at ? $information->expires_at->format('Y-m-d\TH:i') : '') }}"
                           class="form-control">
                </div>
                <small class="form-text">Kosongkan jika tidak ada kadaluarsa</small>
            </div>
        </div>

        <div class="form-group">
            <label class="checkbox-label">
                <input type="checkbox" 
                       name="is_published" 
                       value="1" 
                       {{ old('is_published', $information->is_published) ? 'checked' : '' }}>
                Publikasikan segera
            </label>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.information.index') }}" class="btn btn-secondary">
                ← Kembali
            </a>
            <button type="submit" class="btn btn-primary">
                💾 Update Informasi
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
            background: white;
            border-radius: 16px;
            padding: 32px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #10b981, #06b6d4);
        }

        .header h1 {
            color: #1e293b !important;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .header p {
            color: #64748b !important;
            font-size: 15px;
        }

        .form {
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
            color: #1e293b !important;
            font-weight: 600 !important;
            font-size: 14px;
            letter-spacing: -0.01em;
        }

        .form-group label::before {
            content: '';
            width: 4px;
            height: 16px;
            background: linear-gradient(135deg, #10b981, #06b6d4);
            border-radius: 2px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            color: #64748b;
            font-size: 18px;
            pointer-events: none;
            transition: all 0.2s ease;
            z-index: 1;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: #ffffff !important;
            color: #1e293b !important;
            font-family: 'Inter', sans-serif;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            outline: none;
            border-color: #10b981 !important;
            background-color: #ffffff !important;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1), 0 4px 12px rgba(0, 0, 0, 0.08) !important;
            transform: translateY(-1px);
        }

        .form-control::placeholder {
            color: #94a3b8 !important;
            font-weight: 400;
        }

        textarea.form-control {
            padding: 14px 16px;
            min-height: 150px;
            resize: vertical;
            line-height: 1.6;
        }

        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 12px;
            padding-right: 40px;
        }

        select.form-control option {
            color: #1e293b !important;
            background-color: #ffffff !important;
            padding: 12px;
        }

        .form-control:focus ~ .input-icon {
            color: #10b981;
            transform: scale(1.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-text {
            color: #64748b !important;
            font-size: 13px;
            margin-top: 6px;
            display: block;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #374151 !important;
            font-weight: 500;
            cursor: pointer;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .checkbox-label:hover {
            background: #f8fafc;
        }

        .checkbox-label input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: #10b981;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #e2e8f0;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #475569;
            border: 2px solid #e2e8f0;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .form-actions {
                flex-direction: column;
            }
        }
</style>
@endsection
