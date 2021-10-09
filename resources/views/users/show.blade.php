@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">
      <label class="col-md-4 col-form-label text-md-right"> 名前：</label>
          <div class="col-md-4">
            {{ $user->name }}
          </div>
  </div>
  <div class="row justify-content-center">
      <label class="col-md-4 col-form-label text-md-right"> SNSアカウント：</label>
          <div class="col-md-4">
          {{ $user->sns }}
          </div>
  </div>

@endsection