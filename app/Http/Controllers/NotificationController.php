<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $notifications = Notification::latest()->take(10)->get();
        $unreadCount = Notification::where('is_read', false)->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count'  => $unreadCount
        ]);
    }

    public function markAsRead($id)
    {
        if ($id === 'all') {
            Notification::query()->update(['is_read' => true]);
        } else {
            Notification::where('id', $id)->update(['is_read' => true]);
        }

        return redirect()->back()->with('success', 'Notifications updated.');
    }

    public function clearAll()
    {
        Notification::truncate();
        return redirect()->back()->with('success', 'All notifications cleared.');
    }
}
