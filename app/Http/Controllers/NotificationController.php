<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {

        if ($id) {
            Auth::user()->unreadNotifications->where('id',$id)->markAsRead();
        }

        return back();
    }
}
