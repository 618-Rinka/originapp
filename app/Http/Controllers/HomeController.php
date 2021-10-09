<?php

namespace App\Http\Controllers;

use App\Models\Topic;

class HomeController extends Controller
{
    public function index()
    {
        // NOTE: 最大6件までとする
        $topics = Topic::with(['user'])->orderBy('created_at','desc')->limit(6)->get();
        return view('index', ['topics' => $topics]);
    }
}
