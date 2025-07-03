<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

class CustomerLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/my-profile';

    protected function guard()
    {
        return Auth::guard('customer');
    }


    function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    function facebookLogin()
    {
        return Socialite::driver('facebook')->redirect();
    }

    function googleRedirect()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $userArray = [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => null,
            'password' => Hash::make(uniqid()),
        ];

        $userData = Customer::updateOrCreate([
            'email' => $userArray['email']
        ], $userArray);

        Auth::guard('customer')->login($userData);
        return to_route('customer.profile');
    }

    function facebookRedirect()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        dd($user);
    }
}

