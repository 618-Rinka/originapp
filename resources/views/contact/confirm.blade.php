@extends('layouts.app')

@section('content')
<div class="container">
<div class="card">
      <div class="card-header">お問い合わせ内容</div>
      <div class="card-body">
        <form method="POST" action="{{ route('contact.send') }}">
            @csrf

            <p class="mail">
            <label>メールアドレス：</label>
            {{ $inputs['email'] }}
            <input
                name="email"
                value="{{ $inputs['email'] }}"
                type="hidden">
            </p>

            <p class="name">
            <label>名前：</label>
            {{ $inputs['name'] }}
            <input
                name="name"
                value="{{ $inputs['name'] }}"
                type="hidden">
            </p>

            <p class="message">
            <label>お問い合わせ内容：</label>
            {!! nl2br(e($inputs['message'])) !!}
            <input
                name="message"
                value="{{ $inputs['message'] }}"
                type="hidden">
            </p>

            <div class="form-group">
            <button type="submit" class="btn btn-secondary" name="action" value="back">
                入力内容修正 
            </button>
            <button type="submit" class="btn btn-primary" name="action" value="submit">
                送信する
            </button>
            </div>
        </form>
      </div>
</div>
</div>
@endsection