<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MultimediaController extends Controller
{
    public function MultimediaDashboard(){
        return view('multimedia.multimedia_dashboard');
    }
    public function MultimediaLiveStream(){
        return view('multimedia.multimedia_livestream');
    }
    public function MultimediaLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
