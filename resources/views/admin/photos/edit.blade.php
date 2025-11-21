@extends('admin.layouts.app')

@section('title', 'Edit Foto')

@section('page-title', 'Edit Foto')

@section('content')
<style>

        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            margin-bottom: 32px;
        }

        .photo-preview-section {
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--secondary-200);
            position: relative;
            overflow: hidden;
        }

        .photo-preview-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
        }

        .photo-preview-section h2 {
            color: var(--secondary-900);
            font-size: 18px;
            margin-bottom: 24px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--secondary-200);
            font-weight: 600;
        }

        .current-photo {
            text-align: center;
            margin-bottom: 24px;
        }

        .current-photo img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 16px;
            border: 3px solid var(--secondary-200);
            transition: all 0.2s ease;
        }

        .current-photo img:hover {
            border-color: #8b5cf6;
            transform: scale(1.02);
        }

        .photo-info {
            background: var(--secondary-50);
            padding: 20px;
            border-radius: 8px;
            border: 1px solid var(--secondary-200);
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--secondary-200);
        }

        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .info-label {
            font-weight: 500;
            color: var(--secondary-700);
            font-size: 14px;
        }

        .info-value {
            color: var(--secondary-600);
            font-size: 14px;
            text-align: right;
        }

        .edit-form-section {
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--secondary-200);
            position: relative;
            overflow: hidden;
        }

        .edit-form-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #10b981, #06b6d4);
        }

        .edit-form-section h2 {
            color: var(--secondary-900);
            font-size: 18px;
            margin-bottom: 24px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--secondary-200);
            font-weight: 600;
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
            color: #1e293b;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: -0.01em;
        }

        .form-group label::before {
            content: '';
            width: 4px;
            height: 16px;
            background: linear-gradient(135deg, #8b5cf6, #3b82f6);
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

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            color: #1e293b;
            font-family: 'Inter', sans-serif;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .form-group textarea {
            padding: 14px 16px 14px 48px;
            min-height: 100px;
            resize: vertical;
            line-height: 1.6;
        }

        .form-group select {
            padding: 14px 16px 14px 48px;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 12px;
            padding-right: 40px;
        }

        .form-group select option {
            background: white;
            color: #1e293b;
            padding: 12px;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #8b5cf6;
            background: white;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1), 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateY(-1px);
        }

        .form-group input:focus ~ .input-icon,
        .form-group textarea:focus ~ .input-icon,
        .form-group select:focus ~ .input-icon {
            color: #8b5cf6;
            transform: scale(1.1);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-input {
            position: absolute;
            left: -9999px;
        }

        .file-input-label {
            display: block;
            padding: 16px;
            background: var(--secondary-50);
            border: 2px dashed var(--secondary-300);
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
            color: var(--secondary-600);
            font-size: 14px;
            position: relative;
        }

        .file-input-label::before {
            content: '\f07b';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            display: block;
            font-size: 24px;
            margin-bottom: 8px;
            opacity: 0.7;
        }

        .file-input-label:hover {
            background: var(--secondary-100);
            border-color: #10b981;
            color: var(--secondary-700);
            transform: translateY(-1px);
        }

        .file-input:focus + .file-input-label {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .update-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: black;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            flex: 1;
            box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2);
        }

        .update-btn:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(16, 185, 129, 0.3);
        }

        .cancel-btn {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            color: black;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            text-align: center;
            flex: 1;
            box-shadow: 0 2px 4px rgba(100, 116, 139, 0.2);
        }

        .cancel-btn:hover {
            background: linear-gradient(135deg, #475569 0%, #374151 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(100, 116, 139, 0.3);
        }

        @media (max-width: 1024px) {
            .main-content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .photo-preview-section,
            .edit-form-section {
                padding: 24px;
            }
            
            .form-actions {
                flex-direction: column;
            }
        }
</style>

<div class="main-content">
            <div class="photo-preview-section">
                <h2>Foto Saat Ini</h2>
                
                <div class="current-photo">
                    <img src="{{ $photo->photo_url }}" 
                         alt="{{ $photo->title }}" 
                         class="current-photo"
                         onerror="this.src='{{ asset('images/no-image.png') }}'; this.onerror=null;">
                </div>
                
                <div class="photo-info">
                    <div class="info-item">
                        <span class="info-label">Judul:</span>
                        <span class="info-value">{{ $photo->title }}</span>
                    </div>
                    
                    @if($photo->description)
                        <div class="info-item">
                            <span class="info-label">Deskripsi:</span>
                            <span class="info-value">{{ $photo->description }}</span>
                        </div>
                    @endif
                    
                    <div class="info-item">
                        <span class="info-label">Kategori:</span>
                        <span class="info-value">{{ ucfirst($photo->category) }}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Upload oleh:</span>
                        <span class="info-value">{{ $photo->user->name ?: $photo->user->username }}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Tanggal upload:</span>
                        <span class="info-value">{{ $photo->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Terakhir update:</span>
                        <span class="info-value">{{ $photo->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <div class="edit-form-section">
                <h2>Form Edit</h2>
                
                <form method="POST" action="{{ route('admin.photos.update', $photo->id) }}" enctype="multipart/form-data" onsubmit="saveScrollPosition()">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="title">Judul Foto</label>
                        <div class="input-wrapper">
                            <i class="fas fa-heading input-icon"></i>
                            <input type="text" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $photo->title) }}" 
                                   required 
                                   placeholder="Masukkan judul foto">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <div class="input-wrapper">
                            <i class="fas fa-align-left input-icon" style="top: 16px;"></i>
                            <textarea id="description" 
                                      name="description" 
                                      rows="4" 
                                      placeholder="Deskripsi foto (opsional)">{{ old('description', $photo->description) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <div class="input-wrapper">
                            <i class="fas fa-tags input-icon"></i>
                            <select id="category" name="category" required>
                            <option value="">Pilih Kategori</option>
                            @foreach(\App\Helpers\CategoryHelper::getCategories() as $key => $name)
                                <option value="{{ $key }}" {{ old('category', $photo->category) == $key ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="photo">Ganti Foto (Opsional)</label>
                        <div class="file-input-wrapper">
                            <input type="file" 
                                   id="photo" 
                                   name="photo" 
                                   accept="image/*" 
                                   class="file-input">
                            <label for="photo" class="file-input-label">
                                Klik untuk memilih foto baru atau drag & drop
                            </label>
                        </div>
                        <small style="color: #64748b; font-size: 12px; margin-top: 4px; display: block;">
                            Format: JPEG, PNG, JPG, GIF. Maksimal 2MB.
                        </small>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="update-btn">Update Foto</button>
                        <a href="{{ route('admin.photos.index') }}" class="cancel-btn">Batal</a>
                    </div>
                </form>
            </div>
        </div>
@endsection

@push('scripts')
<script>
// Save scroll position before form submit
function saveScrollPosition() {
    sessionStorage.setItem('scrollPosition', window.scrollY);
}

// Restore scroll position after page load  
window.addEventListener('load', function() {
    const scrollPosition = sessionStorage.getItem('scrollPosition');
    if (scrollPosition) {
        window.scrollTo(0, parseInt(scrollPosition));
        sessionStorage.removeItem('scrollPosition');
    }
});
</script>
@endpush
