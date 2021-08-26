<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Topic;


class LikeController extends Controller
{
    public function index()
    {
        $topics = Auth::user()->likingPosts;

        return view('likes.index', ['topics' => $topics]);
    }

    public function add(Topic $topic)
    {
        Auth::user()->likingPosts()->attach($topic->id);

        return redirect()->back();
    }
    
    public function remove(Topic $topic)
    {
        Auth::user()->likingPosts()->detach($topic->id);

        return redirect()->back();
    }
}