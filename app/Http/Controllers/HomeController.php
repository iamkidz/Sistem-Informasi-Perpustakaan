<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $total_buku = Buku::get()->count();
        $total_peminjam = Peminjaman::get()->count();
        $total_user = User::get()->count();

        if($user->level == 3) {
            return redirect('buku');
        } else {
            return view('dashboard', compact('total_buku', 'total_peminjam', 'total_user'));
        }

    }
}
