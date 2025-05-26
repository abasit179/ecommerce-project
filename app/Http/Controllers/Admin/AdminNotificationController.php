<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminNotification;

class AdminNotificationController extends Controller
{
    public function fetchNotifications()
    {
        // Fetch the latest notifications from the database
        $notifications = AdminNotification::orderBy('created_at', 'desc')->where('is_read', '0')->get();

        // Return JSON response
        return response()->json($notifications);
    }
}
