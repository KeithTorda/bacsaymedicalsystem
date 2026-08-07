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
     * Get role-filtered notifications for current user.
     */
    public function index()
    {
        $user = Auth::user();
        $userRole = strtolower($user->role_name ?? 'staff');

        $query = Notification::query()
            ->where(function($q) use ($user, $userRole) {
                $q->where('user_id', $user->id)
                  ->orWhere('target_role', 'all')
                  ->orWhere('target_role', $userRole)
                  ->orWhere('target_role', ucfirst($userRole));
            });

        $notifications = $query->latest()->take(10)->get();
        $unreadCount = (clone $query)->where('is_read', false)->count();

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
        $user = Auth::user();
        $userRole = strtolower($user->role_name ?? 'staff');

        if ($id === 'all') {
            Notification::where(function($q) use ($user, $userRole) {
                $q->where('user_id', $user->id)
                  ->orWhere('target_role', 'all')
                  ->orWhere('target_role', $userRole)
                  ->orWhere('target_role', ucfirst($userRole));
            })->update(['is_read' => true]);
        } else {
            Notification::where('id', $id)->update(['is_read' => true]);
        }

        return redirect()->back()->with('success', 'Notifications updated.');
    }

    /**
     * Clear all notifications for current user context.
     */
    public function clearAll()
    {
        $user = Auth::user();
        $userRole = strtolower($user->role_name ?? 'staff');

        Notification::where(function($q) use ($user, $userRole) {
            $q->where('user_id', $user->id)
              ->orWhere('target_role', 'all')
              ->orWhere('target_role', $userRole)
              ->orWhere('target_role', ucfirst($userRole));
        })->delete();

        return redirect()->back()->with('success', 'Notifications cleared.');
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
