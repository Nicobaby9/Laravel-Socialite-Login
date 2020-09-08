<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Socialite;
use App\User;


class GithubController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }
 
    public function callback()
    {
          $user = Socialite::driver('github')->user();

            // $user->token;
            // dd($user);

            $user = User::firstOrCreate([

                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'github_id' => $user->getId(),
                'password' => md5($user->token),

            ]);

            Auth::Login($user, true);
            return redirect('/home');
        
    }
}