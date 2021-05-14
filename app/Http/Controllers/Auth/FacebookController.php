<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Exception;
use App\User;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {    
            $user = Socialite::driver('facebook')->user();
            
            $finduser = User::where('provider_id', $user->id)->first();
            if($finduser){  
                Auth::login($finduser);
                return redirect('/attendance');    
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'provider_id'=> $user->id,
                    'password' => encrypt('password')
                ]);
    
                Auth::login($newUser);
     
                return redirect('/attendance');
            }
    
        } catch (Exception $e) {
            return redirect('login');
            dd($e->getMessage());
        }
    }
}
