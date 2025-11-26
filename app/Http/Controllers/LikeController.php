<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Photo;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Toggle like for a photo
     */
    public function toggle(Request $request, $photoId)
    {
        try {
            // Check if user is logged in
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda harus login terlebih dahulu untuk menyukai foto. Silakan login atau daftar untuk melanjutkan.'
                ], 401);
            }
            
            $photo = Photo::findOrFail($photoId);
            $user = auth()->user();
            
            // Check if user is admin
            if ($user && $user->role === 'admin') {
                return response()->json([
                    'success' => false,
                    'message' => 'Admin tidak diperbolehkan memberikan like.'
                ], 403);
            }
            
            $ipAddress = $request->ip();
            $userAgent = $request->userAgent();
            $userId = $user ? $user->id : null;

            // Check if already liked
            if ($userId) {
                // For logged-in users, check by user_id
                $existingLike = Like::where('photo_id', $photoId)
                    ->where('user_id', $userId)
                    ->first();
            } else {
                // For guests, check by IP address
                $existingLike = Like::where('photo_id', $photoId)
                    ->where('ip_address', $ipAddress)
                    ->whereNull('user_id')
                    ->first();
            }

            if ($existingLike) {
                // Unlike
                $existingLike->delete();
                $liked = false;
                $message = 'Like dibatalkan';
            } else {
                // Like
                $like = Like::create([
                    'photo_id' => $photoId,
                    'user_id' => $userId,
                    'ip_address' => $ipAddress,
                    'user_agent' => $userAgent
                ]);
                $liked = true;
                $message = 'Foto berhasil disukai!';
                
                // Buat notifikasi untuk admin
                $userName = $userId ? auth()->user()->name : 'Pengunjung';
                \App\Models\Notification::create([
                    'type' => 'like',
                    'message' => $userName . ' menyukai foto "' . ($photo->title ?? 'Foto #' . $photoId) . '"',
                    'user_id' => $userId,
                    'photo_id' => $photoId,
                    'url' => '/gallery/photos?photo=' . $photoId,
                    'is_read' => false
                ]);
            }

            // Refresh photo to get updated relationships
            $photo->refresh();

            // Get updated likes count
            $likesCount = $photo->likes()->count();

            // Get list of users who liked (for logged-in users only)
            $likedUsers = $photo->likes()
                ->whereNotNull('user_id')
                ->with('user:id,name')
                ->get()
                ->pluck('user.name')
                ->filter()
                ->values()
                ->toArray();

            return response()->json([
                'success' => true,
                'liked' => $liked,
                'likes_count' => $likesCount,
                'liked_users' => $likedUsers,
                'message' => $message
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \Log::error('Photo not found for like', [
                'photo_id' => $photoId,
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Foto tidak ditemukan.'
            ], 404);
            
        } catch (\Exception $e) {
            \Log::error('Error toggling like', [
                'photo_id' => $photoId,
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses like. Silakan coba lagi.'
            ], 500);
        }
    }
}
