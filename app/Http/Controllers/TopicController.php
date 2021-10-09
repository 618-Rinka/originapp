<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use App\Models\Reply;
use App\Http\Requests\User\StoreRequest;
use App\Models\User;
<<<<<<< HEAD

=======
>>>>>>> a1ecf78833055f938e3e54967d9b93037fa4e73f

class TopicController extends Controller
{
    public function index(Request $request)
    {
<<<<<<< HEAD
        //$topics = Topic::with(['user'])->orderBy('created_at','desc')->get();
        //return view('index', ['topics' => $topics]);

=======
>>>>>>> a1ecf78833055f938e3e54967d9b93037fa4e73f
        $topics = Topic::with(['user'])
            ->when($request->keyword ?? null, function($query, $keyword) {
                $query->where(function($query) use ($keyword) {
                    $query
                        ->where('body', 'like', '%' . $keyword . '%')
                        ->orWhereIn(
                            'user_id',
                            User::select('id')->where('name', 'like', '%' . $keyword . '%')->getQuery()
                        );
                });
            })
            ->orderBy('created_at','desc')
            ->paginate();
        return view('topics.index', ['topics' => $topics]);
    }
    public function create()
    {
        return view('topics.create');
    }
    public function store(StoreRequest $request)
    {
<<<<<<< HEAD
       // if($file = $request->image){
        //    $filename=time().'.'.$file->getClientOriginalName();
        //    $target_path = public_path('/uploads/');
        //    $file->move($target_path,$filename);

        if($file = $request->image) {
            $filename = base64_encode(file_get_contents($file->getRealPath()));
        } else {
            $filename= null;
=======
        if($file = $request->image) {
            $filename = base64_encode(file_get_contents($file->getRealPath()));
        } else {
            $filename = null;
>>>>>>> a1ecf78833055f938e3e54967d9b93037fa4e73f
        }

    
        $topic = new Topic;
        $topic->fill($request->all());
        $topic->user()->associate(Auth::user());
        $topic->image = $filename;
        $topic->save();

        return redirect()->route('topics.index')->with('success', 'トピックスが投稿されました');
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
<<<<<<< HEAD

   // public function indexsearch(Request $request)
   // {
    //    $keyword = $request->input('keyword');
 
   //     $query = Topic::query();
 
     //   if (!empty($keyword)) {
   //         $query->where('body', 'LIKE', "%{$keyword}%");
   //     }
 
 
   //     $topics = $query->get();
 
    //    return view('index', compact('keyword'));
   // }

=======
>>>>>>> a1ecf78833055f938e3e54967d9b93037fa4e73f
}
