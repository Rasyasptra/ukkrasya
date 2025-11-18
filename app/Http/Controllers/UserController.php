<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Information;
use App\Models\Like;
use App\Models\Comment;
use App\Helpers\CategoryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get statistics
        $totalPhotos = Photo::count();
        $totalCategories = count(CategoryHelper::getCategories());
        $recentPhotos = Photo::where('created_at', '>=', now()->subDays(30))->count();
        $totalViews = Photo::sum('views') ?? 0;
        
        // Get recent photos for preview
        $recentPhotosList = Photo::orderBy('created_at', 'desc')
            ->take(6)
            ->get()
            ->map(function ($photo) {
                $photo->category_name = CategoryHelper::getCategoryName($photo->category);
                return $photo;
            });
        
        // Get recent information for dashboard
        $recentInfo = Information::where('is_published', true)
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        
        return view('user.dashboard', compact(
            'totalPhotos',
            'totalCategories', 
            'recentPhotos',
            'totalViews',
            'recentPhotosList',
            'recentInfo'
        ));
    }

    public function information()
    {
        $informations = Information::where('is_published', true)
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.information', compact('informations'));
    }

    public function profile()
    {
        $user = Auth::user();
        
        // Get user statistics
        $totalLikes = Like::where('user_id', $user->id)->count();
        $totalComments = Comment::where('user_id', $user->id)->count();
        $likedPhotos = Photo::whereHas('likes', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();
        
        // Get recent activity
        $recentLikes = Like::where('user_id', $user->id)
            ->with('photo')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        $recentComments = Comment::where('user_id', $user->id)
            ->with('photo')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        return view('user.profile', compact(
            'user',
            'totalLikes',
            'totalComments',
            'likedPhotos',
            'recentLikes',
            'recentComments'
        ));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'current_password.required_with' => 'Password lama wajib diisi untuk mengubah password',
            'new_password.min' => 'Password baru minimal 6 karakter',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Update basic info
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->birth_date = $request->birth_date;
            $user->gender = $request->gender;
            
            // Update password if provided
            if ($request->filled('new_password')) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return redirect()->back()
                        ->withErrors(['current_password' => 'Password lama tidak sesuai'])
                        ->withInput();
                }
                $user->password = Hash::make($request->new_password);
            }
            
            $user->save();

            return redirect()->route('user.profile')
                ->with('success', 'Profil berhasil diperbarui!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui profil: ' . $e->getMessage()])
                ->withInput();
        }
    }
}
