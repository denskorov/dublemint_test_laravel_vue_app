<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(Request $request)
    {
        if (!$request->hasValidSignature()) {
            return auth()->logout();
//            return redirect('/login');
        }

        return view('home');
    }
}
