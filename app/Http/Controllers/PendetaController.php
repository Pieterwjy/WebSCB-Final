<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendetaController extends Controller
{
    public function PendetaDashboard(){
        return view('pendeta.pendeta_dashboard');
    }
    public function PendetaAkun(){
        return view('pendeta.pendeta_akun');
    }
    public function PendetaPengumuman(){
        return view('pendeta.pendeta_pengumuman');
    }
    public function PendetaLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
