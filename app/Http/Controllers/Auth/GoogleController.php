<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Exception;
use App\User;

class GoogleController extends Controller
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
            dd($e->getMessage());
        }
    }
    
}
