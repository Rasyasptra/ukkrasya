<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;
use App\Helpers\CategoryHelper;
use App\Tools\FileManager;
use App\Tools\DataValidator;
use App\Tools\CacheManager;

class PhotoController extends Controller
{
    protected $fileManager;
    protected $dataValidator;
    protected $cacheManager;

    public function __construct()
    {
        $this->fileManager = new FileManager();
        $this->dataValidator = new DataValidator();
        $this->cacheManager = new CacheManager();
    }

    public function index(Request $request)
    {
        $query = Photo::with('user');
        
        // Filter berdasarkan kategori jika ada
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
        
        // Search berdasarkan judul atau deskripsi dengan validasi
        if ($request->filled('search')) {
            $search = $this->dataValidator->validateSearchQuery($request->search);
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Apply sorting with validation
        $sort = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');
        $query->orderBy($sort, $order);
        
        $photos = $query->paginate(12)->withQueryString();
        
        // Get all available categories for filter dropdown with caching
        $categories = $this->cacheManager->getCategoryOptions();
        
        return view('admin.photos.index', compact('photos', 'categories'));
    }

    public function store(Request $request)
    {
        try {
            // Debug logging
            \Log::info('Photo upload started', [
                'has_file' => $request->hasFile('photo'),
                'file_name' => $request->hasFile('photo') ? $request->file('photo')->getClientOriginalName() : 'no file',
                'file_size' => $request->hasFile('photo') ? $request->file('photo')->getSize() : 0,
                'title' => $request->title,
                'category' => $request->category,
            ]);

            // Check if file exists
            if (!$request->hasFile('photo')) {
                \Log::error('No photo file in request');
                return redirect()->back()
                    ->with('error', 'File foto tidak ditemukan. Silakan pilih file foto terlebih dahulu.')
                    ->withInput();
            }

            $uploadedFile = $request->file('photo');
            
            // Validate data using DataValidator
            $validatedData = $this->dataValidator->validatePhotoData([
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'file' => $uploadedFile,
                'uploaded_by' => Auth::id()
            ]);

            // Upload and process file using FileManager
            $fileInfo = $this->fileManager->uploadImage(
                $uploadedFile,
                $validatedData['category']
            );

            \Log::info('File uploaded successfully', [
                'filename' => $fileInfo['filename'],
                'file_path' => $fileInfo['original_path'],
                'file_size' => $fileInfo['file_size'] ?? 0,
            ]);

            // Create photo record
            $photo = Photo::create([
                'title' => $this->dataValidator->sanitizeString($validatedData['title']),
                'description' => $validatedData['description'] ? 
                    $this->dataValidator->sanitizeString($validatedData['description']) : null,
                'filename' => $fileInfo['filename'],
                'file_path' => $fileInfo['original_path'],
                'category' => $validatedData['category'],
                'uploaded_by' => $validatedData['uploaded_by']
            ]);

            \Log::info('Photo record created', [
                'photo_id' => $photo->id,
                'photo_url' => $photo->photo_url,
            ]);

            // Clear cache
            $this->cacheManager->clearPhotosCache();

            return redirect()->route('admin.photos.index')
                ->with('success', 'Foto berhasil ditambahkan!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error', [
                'errors' => $e->errors(),
            ]);
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            \Log::error('Failed to upload photo', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => Auth::id()
            ]);
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengupload foto: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        return view('admin.photos.edit', compact('photo'));
    }

    public function update(Request $request, $id)
    {
        $photo = Photo::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Update basic info
        $photo->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
        ]);

        // Update photo file if new one is uploaded
        if ($request->hasFile('photo')) {
            // Delete old file
            if (Storage::disk('public')->exists($photo->file_path)) {
                Storage::disk('public')->delete($photo->file_path);
            }
            
            // Store new file
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('photos', $filename, 'public');
            
            $photo->update([
                'filename' => $filename,
                'file_path' => $filePath,
            ]);
        }

        return redirect()->route('admin.photos.index')->with('success', 'Foto berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            $photo = Photo::findOrFail($id);
            
            // Delete file and thumbnail using FileManager
            $this->fileManager->deleteFile($photo->file_path);
            
            // Delete record from database
            $photo->delete();

            // Clear cache
            $this->cacheManager->clearPhotosCache();

            return redirect()->route('admin.photos.index')
                ->with('success', 'Foto berhasil dihapus!');

        } catch (\Exception $e) {
            \Log::error('Failed to delete photo', [
                'photo_id' => $id,
                'error' => $e->getMessage(),
                'user_id' => Auth::id()
            ]);
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus foto. Silakan coba lagi.');
        }
    }
}
