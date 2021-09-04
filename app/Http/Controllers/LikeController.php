<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Topic;
use App\Models\Reply;


class LikeController extends Controller
{
    public function index()
    {
        $topics = Auth::user()->likingTopics;

        return view('likes.index', ['topics' => $topics]);
    }

    public function add(Topic $topic)
    {
        Auth::user()->likingTopics()->attach($topic->id);

        return redirect()->back();
    }

    public function remove(Topic $topic)
    {
        Auth::user()->likingTopics()->detach($topic->id);

        return redirect()->back();
    }

    public function indexReply()
    {
        $replies = Auth::user()->likingReplies;

        return view('likes.reply.index', ['replies' => $replies]);
    }
    
    public function addReply(Reply $reply)
    {
        $reply = Auth::user()->likingReplies()->where('replies.id', $reply->id)->first();
        $count = $reply->pivot->count;
        if ($count < 10) {
            Auth::user()->likingReplies()->detach($reply->id);
            Auth::user()->likingReplies()->attach($reply->id, ['count' => $count + 1]);
        }

        return redirect()->back();
    }
    
    public function removeReply(Reply $reply)
    {
        Auth::user()->likingReplies()->detach($reply->id);

        return redirect()->back();
    }
}