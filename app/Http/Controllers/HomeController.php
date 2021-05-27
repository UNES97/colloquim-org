<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $nbr_expert = DB::table('experts')->count();
        $nbr_auteur = DB::table('auteurs')->count();
        $nbr_participant = DB::table('participants')->count();
        $nbr_session = DB::table('sessions')->count();
        $nbr_articles = DB::table('articles')->count();
        $nbr_rejected = DB::table('articles')->where('id_session',NULL)->count();
        $nbr_accepted = DB::table('articles')->where('id_session','!=',NULL)->count();
        return view('home' ,  ['nbr_expert' => $nbr_expert , 'nbr_participant' => $nbr_participant , 'nbr_auteur' => $nbr_auteur , 'nbr_session' => $nbr_session , 'nbr_articles'=>$nbr_articles , 'nbr_rejected'=>$nbr_rejected , 'nbr_accepted'=>$nbr_accepted ]  );    }
    }
