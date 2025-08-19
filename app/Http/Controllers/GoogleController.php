<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
       return Socialite::driver('google')
        ->with(['prompt' => 'select_account'])
        ->redirect();
    }   

    public function handleGoogleCallback(Request $request)
    {
      
        $user = Socialite::driver('google')->user();
        $findUser = User::where("email", $user->getEmail())->first();
       
        if(!is_null($findUser)){
            Auth::login($findUser);
        }else{
            $user = User::create([
                "name" => $user->name,
                "email" => $user->email,
                "google_id" => $user->id,
                "password" => encrypt("password"),
            ]);
            Auth::login($user);
        }
        return redirect("dashboard");
    }   
}
