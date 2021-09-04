<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Topic;
use App\Models\Reply;


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

    public function indexReply()
    {
        $replies = Auth::user()->likingReplies;

        return view('likes.reply.index', ['replies' => $replies]);
    }
    
    public function addReply(Reply $reply)
    {
        Auth::user()->likingReplies()->attach($reply->id, [ 'topic_id' => $reply->topic_id ]);

        return redirect()->back();
    }
    
    public function removeReply(Reply $reply)
    {
        Auth::user()->likingReplies()->detach($reply->id);

        return redirect()->back();
    }
}