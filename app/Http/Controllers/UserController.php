<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Notification;
use Session;
use App\Notifications\SendNotification;

class UserController extends Controller
{

    public function index(){
        $users = User::all();
        return view('notification.index',compact('users'));
    }

    // public static function sendNotification(Request $request)
    // {
    //     $users = User::find($request->users);
  
    //     foreach($users as $user){
    //         $details = [
    //             'greeting' => 'Hi'.$user->name,
    //             'message' => $request->message,
    //             'thanks' => 'Thank you !',
    //             'actionURL' => url('/'),
    //             'user_id' => $user->id
    //         ];
    //         Notification::send($user, new SendNotification($details));
    //     }   

    //     Session::put('success','Notification Send Successfully');
    //     return back();
    // }


    public static function sendNotification(Request $request)
    {
        $user = User::find(1);        
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
