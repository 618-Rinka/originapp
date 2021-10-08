<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use App\Models\Reply;
use App\Http\Requests\User\StoreRequest;


class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::with(['user'])->orderBy('created_at','desc')->get();

        return view('index', ['topics' => $topics]);
    }
    public function create()
    {
        return view('topics.create');
    }
    public function store(StoreRequest $request)
    {
        if($file = $request->image){
            $filename=time().'.'.$file->getClientOriginalName();
            $target_path = public_path('/uploads/');
            $file->move($target_path,$filename);
        } else {
            $filename="";
        }

    
        $topic = new Topic;
        $topic->fill($request->all());
        $topic->user()->associate(Auth::user()); // ★
        $topic->image = $filename;
        $topic->save();

        return redirect()->to('/'); // '/' へリダイレクト
    }
    public function delete(Topic $topic)
    {
        if (Auth::id() !== $topic->user_id){
            abort(403);
        }
        
        $topic->delete();

        return redirect()->to('/');
    }
    public function show(Topic $topic)
    {
        $topic->load('replies.user');
        $liked=$topic->likingUsers->contains(Auth::id());

        return view('topics.show', ['topic'=>$topic, 'liked'=>$liked]);
    }
    public function reply(Request $request, Topic $topic)
    {
        $reply = new Reply;
        $reply->fill($request->all());
        $reply->user()->associate(Auth::user());
        $reply->topic()->associate($topic);
        $reply->save();

        return redirect()->back();
    }

    public function indexsearch(Request $request)
    {
        $keyword = $request->input('keyword');
 
        $query = Topic::query();
 
        if (!empty($keyword)) {
            $query->where('body', 'LIKE', "%{$keyword}%");
        }
 
 
        $topics = $query->get();
 
        return view('index', compact('keyword'));
    }

}
