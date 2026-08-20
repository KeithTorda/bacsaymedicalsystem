<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get unread notifications for current user/system.
     */
    public function index()
    {
        $notifications = Notification::where('is_read', false)->latest()->take(10)->get();
        $unreadCount = $notifications->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count'  => $unreadCount
        ]);
    }

    /**
     * Mark notification(s) as read.
     */
    public function markAsRead($id)
    {
        if ($id === 'all') {
            Notification::where('is_read', false)->update(['is_read' => true]);
        } else {
            Notification::where('id', $id)->update(['is_read' => true]);
        }

        return redirect()->back()->with('success', 'Notifications marked as read.');
    }

    /**
     * Clear all notifications completely.
     */
    public function clearAll()
    {
        Notification::query()->delete();

        return redirect()->back()->with('success', 'All notifications cleared successfully.');
    }

    /**
     * Helper to dispatch role-specific notifications dynamically.
     */
    public static function notify($title, $message, $targetRole = 'all', $type = 'info', $userId = null)
    {
        return Notification::create([
            'user_id' => $userId,
            'target_role' => $targetRole,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'is_read' => false,
        ]);
    }
}
