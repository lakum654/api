<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\User;

class SocialController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->user();
     
            $finduser = User::where('provider_id', $user->id)->first();
     
            if($finduser){     
                Auth::login($finduser);    
                return redirect('/home');
     
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'provider_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);
    
                Auth::login($newUser);     
                return redirect('/home');
            }
    
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}
