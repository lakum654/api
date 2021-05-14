<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\User;

class GithubController extends Controller
{
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback(Request $request)
    {
        //https://dev.to/damoscki11/laravel-socialite-sign-in-with-github-laravel-8-0-467e
        try {    
            $user = Socialite::driver('github')->user();
            
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