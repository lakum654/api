<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notification;
use App\User;
use App\Notifications\SendNotification;

class NotifyController extends Controller
{
    public static function sendNotification()
    {
            $user = User::find(9);        
            $details = [
                'greeting' => 'Hi'.$user->name,
                'message' => 'Hello',
                'thanks' => 'Thank you !',
                'actionURL' => url('/'),
                'user_id' => $user->id
            ];
            Notification::send($user, new SendNotification($details));       
        
    }
}
