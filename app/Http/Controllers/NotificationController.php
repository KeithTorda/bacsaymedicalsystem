<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemNotification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function markAllAsRead()
    {
        SystemNotification::whereNull('read_at')->update(['read_at' => now()]);
        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    public function clearAll()
    {
        SystemNotification::truncate();
        return redirect()->back()->with('success', 'All notifications cleared.');
    }
}
