<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Photo;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index($photoId)
    {
        try {
            $comments = Comment::where('photo_id', $photoId)
                ->where('is_approved', true)
                ->with('user:id,name')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($comment) {
                    return [
                        'id' => $comment->id,
                        'user_name' => $comment->user ? $comment->user->name : $comment->name,
                        'user_id' => $comment->user_id,
                        'comment' => $comment->comment,
                        'created_at' => $comment->created_at->diffForHumans()
                    ];
                });

            return response()->json([
                'success' => true,
                'comments' => $comments
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil komentar'
            ], 500);
        }
    }

    public function store(Request $request, $photoId)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login terlebih dahulu untuk mengirim komentar'
            ], 401);
        }
        
        // Check if user is admin (admins cannot comment)
        if (auth()->user()->role === 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Admin tidak dapat mengirim komentar'
            ], 403);
        }
        
        $userId = auth()->id();
        
        // Validation rules differ for logged-in users vs guests
        if ($userId) {
            // For logged-in users, name and email are optional (will use user's data)
            $validator = Validator::make($request->all(), [
                'comment' => 'required|string|max:1000'
            ], [
                'comment.required' => 'Komentar wajib diisi',
                'comment.max' => 'Komentar maksimal 1000 karakter'
            ]);
        } else {
            // For guests, name is required
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'nullable|email|max:255',
                'comment' => 'required|string|max:1000'
            ], [
                'name.required' => 'Nama wajib diisi',
                'email.email' => 'Format email tidak valid',
                'comment.required' => 'Komentar wajib diisi',
                'comment.max' => 'Komentar maksimal 1000 karakter'
            ]);
        }

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $commentData = [
                'photo_id' => $photoId,
                'comment' => $request->comment,
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now()
            ];

            if ($userId) {
                // For logged-in users, use their account data
                $user = auth()->user();
                $commentData['user_id'] = $userId;
                $commentData['name'] = $user->name;
                $commentData['email'] = $user->email;
            } else {
                // For guests, use provided name and email
                $commentData['name'] = $request->name;
                $commentData['email'] = $request->email;
            }

            $comment = Comment::create($commentData);

            // Buat notifikasi untuk admin
            $photo = Photo::find($photoId);
            $userName = $userId ? auth()->user()->name : $request->name;
            
            Notification::create([
                'type' => 'comment',
                'message' => $userName . ' mengomentari foto "' . ($photo->title ?? 'Foto #' . $photoId) . '"',
                'user_id' => $userId,
                'photo_id' => $photoId,
                'comment_id' => $comment->id,
                'url' => '/gallery/photos?photo=' . $photoId,
                'is_read' => false
            ]);

            return response()->json([
                'success' => true,
                'comment' => [
                    'id' => $comment->id,
                    'name' => $comment->name,
                    'comment' => $comment->comment,
                    'created_at' => $comment->created_at->diffForHumans(),
                    'user_id' => $comment->user_id
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan komentar: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->delete();

            return redirect()->back()
                ->with('comment_success', 'Komentar berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('comment_error', 'Terjadi kesalahan saat menghapus komentar');
        }
    }
}
