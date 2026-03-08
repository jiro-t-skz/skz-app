<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return redirect()->route('community.index');
        }

        return view('home.topPage');
    }
}
