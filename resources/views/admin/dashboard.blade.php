@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')
@section('page-subtitle', 'Kelola Web Gallery Sekolah')

@section('content')
<div class="dashboard-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; margin-bottom: 32px;">
    <!-- Total Photos -->
    <div class="card">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <h3 style="font-size: 14px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 8px 0;">Total Foto</h3>
                <p style="font-size: 32px; font-weight: 700; color: #1e293b; margin: 0;">{{ App\Models\Photo::count() }}</p>
            </div>
        </div>
    </div>

    <!-- Total Users -->
    <div class="card">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <h3 style="font-size: 14px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 8px 0;">Total User</h3>
                <p style="font-size: 32px; font-weight: 700; color: #1e293b; margin: 0;">{{ App\Models\User::count() }}</p>
            </div>
        </div>
    </div>

    <!-- Categories -->
    <div class="card">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <h3 style="font-size: 14px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 8px 0;">Kategori Aktif</h3>
                <p style="font-size: 32px; font-weight: 700; color: #1e293b; margin: 0;">{{ App\Models\Photo::select('category')->distinct()->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Information -->
    <div class="card">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <h3 style="font-size: 14px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 8px 0;">Total Informasi</h3>
                <p style="font-size: 32px; font-weight: 700; color: #1e293b; margin: 0;">{{ App\Models\Information::count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card" style="margin-bottom: 32px;">
    <h2 style="font-size: 18px; font-weight: 600; color: #1e293b; margin: 0 0 16px 0;">Aksi Cepat</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
        <a href="{{ route('admin.photos.index') }}" class="btn btn-primary" style="text-decoration: none; justify-content: center;">
            Kelola Foto
        </a>
        <a href="{{ route('admin.information.index') }}" class="btn btn-primary" style="text-decoration: none; justify-content: center;">
            Kelola Informasi
        </a>
        <a href="{{ route('gallery.index') }}" class="btn btn-outline" target="_blank" style="text-decoration: none; justify-content: center;">
            Lihat Galeri
        </a>
        <a href="{{ route('home') }}" class="btn btn-outline" target="_blank" style="text-decoration: none; justify-content: center;">
            Website Publik
        </a>
    </div>
</div>

<!-- Recent Photos -->
<div class="card" style="margin-bottom: 32px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <h2 style="font-size: 18px; font-weight: 600; color: #1e293b; margin: 0;">Foto Terbaru</h2>
        <a href="{{ route('admin.photos.index') }}" class="btn btn-outline" style="text-decoration: none; padding: 8px 16px; font-size: 12px;">Lihat Semua</a>
    </div>
    
    @php
        $recentPhotos = App\Models\Photo::latest()->take(6)->get();
    @endphp
    
    @if($recentPhotos->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 16px;">
            @foreach($recentPhotos as $photo)
                <div style="text-align: center;">
                    <div style="width: 100%; height: 120px; border-radius: 8px; overflow: hidden; margin-bottom: 8px; border: 1px solid #e2e8f0;">
                        <img src="{{ asset('storage/' . $photo->file_path) }}" alt="{{ $photo->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <p style="font-size: 12px; font-weight: 500; color: #374151; margin: 0;">{{ Str::limit($photo->title, 20) }}</p>
                    <p style="font-size: 10px; color: #6b7280; margin: 0;">{{ $photo->created_at->format('d M Y') }}</p>
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align: center; padding: 40px; color: #6b7280;">
            <p style="margin: 0;">Belum ada foto</p>
        </div>
    @endif
</div>

<!-- Recent Information -->
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <h2 style="font-size: 18px; font-weight: 600; color: #1e293b; margin: 0;">Informasi Terbaru</h2>
        <a href="{{ route('admin.information.index') }}" class="btn btn-outline" style="text-decoration: none; padding: 8px 16px; font-size: 12px;">Lihat Semua</a>
    </div>
    
    @php
        $recentInfo = App\Models\Information::latest()->take(3)->get();
    @endphp
    
    @if($recentInfo->count() > 0)
        <div style="display: flex; flex-direction: column; gap: 12px;">
            @foreach($recentInfo as $info)
                <div style="padding: 16px; background: #f8fafc; border-radius: 6px; border: 1px solid #e2e8f0;">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                        <h3 style="font-size: 14px; font-weight: 600; color: #1e293b; margin: 0;">{{ $info->title }}</h3>
                        <span style="font-size: 10px; padding: 2px 6px; background: #3b82f6; color: white; border-radius: 4px; text-transform: uppercase;">{{ $info->type }}</span>
                    </div>
                    <p style="font-size: 12px; color: #6b7280; margin: 0 0 8px 0;">{{ Str::limit($info->content, 100) }}</p>
                    <p style="font-size: 10px; color: #9ca3af; margin: 0;">{{ $info->created_at->format('d M Y H:i') }}</p>
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align: center; padding: 40px; color: #6b7280;">
            <p style="margin: 0;">Belum ada informasi</p>
        </div>
    @endif
</div>

@endsection
