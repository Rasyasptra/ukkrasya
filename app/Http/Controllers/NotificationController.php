<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    // Get unread notification count (for badge)
    public function getUnreadCount()
    {
        $count = Notification::unread()->count();
        return response()->json(['count' => $count]);
    }

    // Get recent notifications
    public function getRecent()
    {
        $notifications = Notification::with(['user', 'photo', 'comment'])
            ->recent()
            ->limit(10)
            ->get()
            ->map(function($notification) {
                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'message' => $notification->message,
                    'url' => $notification->url,
                    'is_read' => $notification->is_read,
                    'created_at' => $notification->created_at->diffForHumans(),
                    'user_name' => $notification->user ? $notification->user->name : 'Guest',
                ];
            });

        return response()->json(['notifications' => $notifications]);
    }

    // Mark notification as read
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    // Mark all as read
    public function markAllAsRead()
    {
        Notification::unread()->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    // Show all notifications page
    public function index()
    {
        $notifications = Notification::with(['user', 'photo', 'comment'])
            ->recent()
            ->paginate(20);

        return view('admin.notifications.index', compact('notifications'));
    }

    // Delete notification
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus');
    }
}
