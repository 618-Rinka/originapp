@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">投稿する</div>

        <div class="card-body">
          <form method="POST" action="{{ route('topics.store') }}" enctype="multipart/form-data">
            @csrf
            @foreach($errors->all() as $message)
              <div>{{ $message }}</div>
            @endforeach

            <div class="form-group row my-2">
              <label for="body" class="col-md-4 col-form-label text-md-right">内容</label>
              <div class="col-md-6">
                <input id="body" type="text" class="form-control" name="body" value="" required autofocus>
              </div>
            </div>
            <!--<form action="{{ route('topics.store') }}" method="POST" enctype="multipart/form-data">
              @csrf 
              <input id="image" type="file" name="image">
            </form>-->
            <div class="form-group row my-2">
              <label for="body" class="col-md-4 col-form-label text-md-right">画像</label>
              <div class="col-md-6">
                <input id="image" type="file" name="image">
              </div>
            </div>
            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">投稿</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection