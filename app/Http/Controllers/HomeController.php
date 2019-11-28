<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller  // ovo je kao kod njih DashboardController
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
        $user_id = auth()->user()->id; //uzimamo id prijavljenog korisnika
        $user = User::find($user_id); // pronalazimo korisnika sa tim idjem
        return view('home')->with('posts', $user->posts); //prenosimo postove korisnika kao parametar
    }
}
