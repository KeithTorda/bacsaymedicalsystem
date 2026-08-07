<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share role-based unread notifications across all views
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $role = strtolower($user->role_name ?? 'staff');

                $query = Notification::query()
                    ->where(function($q) use ($user, $role) {
                        $q->where('user_id', $user->id)
                          ->orWhere('target_role', 'all')
                          ->orWhere('target_role', $role)
                          ->orWhere('target_role', ucfirst($role));
                    });

                $unreadNotifications = (clone $query)->where('is_read', false)->latest()->take(8)->get();
                $unreadCount = (clone $query)->where('is_read', false)->count();

                $view->with('unreadNotifications', $unreadNotifications);
                $view->with('unreadCount', $unreadCount);
            } else {
                $view->with('unreadNotifications', collect());
                $view->with('unreadCount', 0);
            }
        });
    }
}
