@extends('layouts.app')

@section('content')
  @foreach($errors->all() as $message)
    <div>{{ $message }}</div>
  @endforeach

  @if(Session::has('message'))
    <div>{{ Session::get('message') }}</div>
  @else
    <div>変更ボタンを押してください</div>
  @endif

  <form method="POST" action="{{ route('users.update') }}">
      @csrf
      <div class="row g-3">
        <label class="col-md-4 col-form-label text-md-right"> 名前：</label>
          <div class="col-md-6">
           <input name="name" type="text" value="{{$user->name}}" />
          </div>
      </div>

      <div class="row g-3">
        <label class="col-md-4 col-form-label text-md-right"> メールアドレス：</label>
          <div class="col-md-6">
            <input name="email" type="email" value="{{$user->email}}" />
          </div>
      </div>
      <div class="col-md-4 offset-md-5">
        <button type="submit" class="btn btn-outline-primary">変更</button>
      </div>

  </form>
@endsection