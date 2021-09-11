<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Topic;
use App\Models\Reply;
use App\Models\User;

class LikeController extends Controller
{
    public function index()
    {
        $topics = Auth::user()->likingTopics;

        return view('likes.index', ['topics' => $topics]);
    }

    public function add(Topic $topic)
    {
        $likedTopic = Auth::user()->likingTopics()->where('topics.id', $topic->id)->first();
        // 今ログインユーザーが対象の返信に対して何回いいねしたかを取得
        // 最初を0とする
        $count = (optional(optional($likedTopic)->pivot)->count ?? 0) + 1;
        if ($count <= 100) {
            Auth::user()->likingTopics()->detach($topic->id);
            Auth::user()->likingTopics()->attach($topic->id, compact('count'));
        }        

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
        // ログインユーザーがいいねした返信を取得
        // 最初は、 $likedReplyは NULL
        // 2回目以降は、1つReplyのデータが取得可能
        $likedReply = Auth::user()->likingReplies()->where('replies.id', $reply->id)->first();
        // 今ログインユーザーが対象の返信に対して何回いいねしたかを取得
        // 最初を0とする
        $count = (optional(optional($likedReply)->pivot)->count ?? 0) + 1;
        if ($count <= 100) {
            Auth::user()->likingReplies()->detach($reply->id);
            Auth::user()->likingReplies()->attach($reply->id, compact('count'));
        }        
        return redirect()->back();
    }
    
    public function removeReply(Reply $reply)
    {
        Auth::user()->likingReplies()->detach($reply->id);

        return redirect()->back();
    }
}