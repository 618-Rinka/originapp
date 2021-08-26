@extends('layouts.app')

@section('content')
  <div class="container">
    @foreach($topics as $topic)
      <div class="card">
        <div class="card-header">{{ $topic->user->name }}</div>
        <div class="card-body">
          <p class="card-text">{{ $topic->body }}</p>
          <p class="card-text"><a href="{{ route('topics.show', $topic->id) }}">詳細を見る</a></p>

          @auth
          @unless($topic->likingUsers->contains(Auth::id()))
            <form method="POST" action="{{ route('likes.add',$topic->id) }}">
              @csrf
              <button type="submit" class="btn btn-success">いいねする</button>
            </form>
          @else
            <form method="POST" action="{{ route('likes.remove', $topic->id) }}">
             @csrf
             <button type="submit" class="btn btn-danger">いいねを解除する</button>
            </form>
          @endunless
        @endauth

          @if(Auth::id() === $topic->user_id)
            <form method="POST" action="{{ route('topics.delete', $topic->id) }}">
              @csrf
              <button type="submit" class="btn btn-danger">削除</button>
            </form>
          @endif
        </div>
      </div>
    @endforeach
  </div>
@endsection