@extends('layouts.app')

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Landing Page - Start Bootstrap Theme</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="public/assets/favicon.ico" />
        <!-- Google fonts-->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

@section('content')
  <div class="container">
    @foreach($topics as $topic)
      <div class="card">
        <div class="card-header">{{ $topic->user->name }}</div>
        <div class="card-body">
          <p class="card-text">{{ $topic->body }}</p>
          <p class="card-text"><a href="{{ route('topics.show', $topic->id) }}">詳細を見る</a></p>
          @auth
          @php
            $user = $topic->likingUsers->firstWhere('id', Auth::id());
            $count = optional(optional($user)->pivot)->count ?? 0;
          @endphp
          @if($count < 101)
            <form method="POST" action="{{ route('likes.add',$topic->id) }}">
              @csrf
              <button type="submit" class="btn btn-success">いいねする{{ $count > 0 ? '（' . $count . '）' : '' }}</button>
            </form>
          @else
          <button type="submit" class="btn btn-success">いいねは100回までです</button>
          @endif
        @endauth

        @auth
          @if($topic->likingUsers->contains(Auth::id()))
            <form method="POST" action="{{ route('likes.remove', $topic->id) }}">
             @csrf
             <button type="submit" class="btn btn-danger">いいねを解除する</button>
            </form>
          @endif
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