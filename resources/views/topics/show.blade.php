@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header">{{ $topic->user->name }}</div>
      <div class="card-body">
        <p class="card-text">{{ $topic->body }}</p>
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
      </div>
    </div>
  </div>
  <div class="container mt-4">
    @foreach($topic->replies as $reply)
    <div class="card">
      <div class="card-header">{{ $reply->user->name }}</div>
      <div class="card-body">
        <p class="card-text">{{ $reply->body }}</p>
        @auth
          @php
            $user = $reply->likingUsers->firstWhere('id', Auth::id());
            $count = optional(optional($user)->pivot)->count ?? 0;
          @endphp
          @if($count < 10)
            <form method="POST" action="{{ route('likes.addReply',$reply->id) }}">
              @csrf
              <button type="submit" class="btn btn-success">いいねする{{ $count > 0 ? '（' . $count . '）' : '' }}</button>
            </form>
          @else
            <form method="POST" action="{{ route('likes.removeReply', $reply->id) }}">
             @csrf
             <button type="submit" class="btn btn-danger">いいねを解除する</button>
            </form>
          @endif
        @endauth
    @auth
      <div class="card">
        <div class="card-header">{{ Auth::user()->name }}</div>
          <div class="card-body">
            <form method="POST" action="{{ route('topics.reply', $topic->id) }}">
              @csrf
              <div class="form-group">
                <textarea name="body" class="form-control" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">返信する</button>
            </form>
          </div>
        </div>
      </div>
    @endauth
  </div>
@endsection