<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function __construct(){
        // $this->middleware('auth');
    }
    function dashboard() {
        return view('Backend.Dashboard');
    }
}
