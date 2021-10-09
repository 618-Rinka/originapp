<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Illuminate\Http\Request;
=======
>>>>>>> a1ecf78833055f938e3e54967d9b93037fa4e73f
use App\Models\Topic;

class HomeController extends Controller
{
<<<<<<< HEAD
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //public function __construct()
    //{
        //$this->middleware('auth');
    //}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('home');
=======
    public function index()
    {
>>>>>>> a1ecf78833055f938e3e54967d9b93037fa4e73f
        // NOTE: 最大6件までとする
        $topics = Topic::with(['user'])->orderBy('created_at','desc')->limit(6)->get();
        return view('index', ['topics' => $topics]);
    }
}
