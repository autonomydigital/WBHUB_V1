<?php

namespace Modules\Notifications\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\User;

class NotificationController extends Controller
{
    public function alerts()
    {
        $user = Auth::user();
    
        $notifications = $user->notifications()->latest()->limit(10)->get();
        $unreadCount = $user->unreadNotifications->count();
    
        return view('notifications::alerts', compact('notifications', 'unreadCount'));
    }

}
