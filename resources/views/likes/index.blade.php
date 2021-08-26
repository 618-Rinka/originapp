@extends('layouts.app')

@section('content')
  <div class="container">
    @forelse($topics as $topic)
      <div class="card">
        <div class="card-header">{{ $topic->user->name }}</div>
        <div class="card-body">
          <p class="card-text">{{ $topic->body }}</p>
          <p class="card-text"><a href="{{ route('topics.show', $topic->id) }}">詳細を見る</a></p>
        </div>
      </div>
    @empty
      <p>いいねはありません</p>
    @endforelse
  </div>
@endsection