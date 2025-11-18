<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Information;
use App\Helpers\CategoryHelper;

class GalleryController extends Controller
{
    public function home()
    {
        // Get recent published information for home page
        $informations = Information::where('is_published', true)
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        
        // Get recent photos for home page
        $photos = Photo::with('user')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        
        // Get hero photos for background slider (take 3 most recent photos)
        $heroPhotos = Photo::orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        
        return view('home', compact('informations', 'photos', 'heroPhotos'));
    }

    public function index(Request $request)
    {
        // Redirect to gallery photos page (dark theme)
        return redirect()->route('gallery.photos', $request->all());
    }

    public function category(Request $request, $category)
    {
        // Redirect to gallery photos page with category filter
        return redirect()->route('gallery.photos', array_merge($request->all(), ['category' => $category]));
    }

    public function photos(Request $request)
    {
        $query = Photo::with(['user', 'approvedComments', 'likes']);
        
        // Filter berdasarkan kategori jika ada
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
        
        // Search berdasarkan judul atau deskripsi
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        $photos = $query->orderBy('created_at', 'desc')->get();
        
        // Get user IP for checking if they liked photos
        $userIp = $request->ip();
        
        // Get all available categories
        $categories = array_keys(CategoryHelper::getCategories());
        
        // Get statistics
        $totalPhotos = Photo::count();
        $recentPhotos = Photo::where('created_at', '>=', now()->subDays(30))->count();
        $contributors = Photo::distinct('uploaded_by')->count('uploaded_by');
        
        // Get recent information
        $recentInfo = Information::where('is_published', true)
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        
        return view('gallery-photos', compact('photos', 'categories', 'totalPhotos', 'recentPhotos', 'contributors', 'recentInfo', 'userIp'));
    }

    public function informationPage()
    {
        // Get all published information
        $informations = Information::where('is_published', true)
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('information-page', compact('informations'));
    }

    public function downloadPhoto($id)
    {
        $photo = Photo::findOrFail($id);
        
        // Get the file path from URL
        $filePath = public_path(parse_url($photo->photo_url, PHP_URL_PATH));
        
        // Check if file exists
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }
        
        // Generate filename
        $fileName = $photo->title . '_' . $photo->id . '.' . pathinfo($filePath, PATHINFO_EXTENSION);
        
        // Download file
        return response()->download($filePath, $fileName);
    }
}
