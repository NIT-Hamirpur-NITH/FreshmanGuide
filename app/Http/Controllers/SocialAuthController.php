<?php

namespace FreshmanGuide\Http\Controllers;

use Illuminate\Http\Request;

use FreshmanGuide\Http\Requests;
use FreshmanGuide\SocialAccountService;
use Socialite;

class SocialAuthController extends Controller
{
    public function login() {
        if (view()->exists('articles.fb')) {
            return view('articles.fb');
        } else {
            return 'View not found';
        }
    }

    public function redirect() {
        return Socialite::driver('facebook')->redirect(); 
    }

    public function callback(SocialAccountService $service) {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());
        auth()->login($user);
        return redirect()->to('/add');
    }

    public function logout() {
        \Auth::logout();
        return redirect()->to('/add');
    }

}
