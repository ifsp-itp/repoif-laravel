<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function callback(){
        $user = Socialite::driver('facebook')->user();
        dd($user);
    }
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }
}
