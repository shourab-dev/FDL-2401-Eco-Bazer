<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerProfileController extends Controller
{
    function myProfile()
    {
        return "Welcome to our dashboard " . auth('customer')->user()->name;
    }
}
