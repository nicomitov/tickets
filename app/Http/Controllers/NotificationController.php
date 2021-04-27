<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class NotificationController extends Controller
{
    public function __construct()
    {
        // $this->middleware('check_user');
    }

    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    public function show($notification)
    {
        $user = auth()->user();

        $notification = $user->notifications()->findOrFail($notification);
        $notification->markAsRead();

        return redirect($notification->data['url']);
    }

    public function read($notification)
    {
        $user = auth()->user();

        $notification = $user->notifications()->findOrFail($notification);
        $notification->markAsRead();

        return back();
    }

    public function destroy($notification)
    {
        $user = auth()->user();

        $notification = $user->notifications()->findOrFail($notification);
        $notification->delete();

        return back();
    }

    public function markAllAsRead()
    {
        $user = auth()->user();

        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        return back();
    }

    public function deleteAll()
    {
        $user = auth()->user();

        $user->notifications()->delete();

        return back();
    }
}
