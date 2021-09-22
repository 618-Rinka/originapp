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
        <link href="../css/styles.css" rel="stylesheet">
    </head>

@section('content')
  <div class="container">



        <!-- Masthead-->
      <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Welcome To Our Studio!</div>
                <div class="masthead-heading text-uppercase">It's Nice To Meet You</div>
            </div>
      </header>

        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Topic List</h2>
                </div>
                <div class="row">
                  @foreach($topics as $topic)
                    <div class="col-lg-4 col-sm-6 mb-4">
              <!-- Portfolio item 1-->
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
                  </div>
                @endforeach
              </div>
         </section>

   <!-- Contact-->
        <section class="page-section" id="contact">
          <form method="POST" action="{{ route('contact.confirm') }}">
            @csrf
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Contact Us</h2>
                </div>
                <!-- * * * * * * * * * * * * * * *-->
                <!-- * * SB Forms Contact Form * *-->
                <!-- * * * * * * * * * * * * * * *-->
                <!-- This form is pre-integrated with SB Forms.-->
                <!-- To make this form functional, sign up at-->
                <!-- https://startbootstrap.com/solution/contact-forms-->
                <!-- to get an API token!-->
                <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- Name input-->
                                <input class="form-control" name="name" value="{{ old('name') }}" placeholder="Your Name *" data-sb-validations="required" />
                                @if ($errors->has('name'))
                                  <p class="error-message">{{ $errors->first('email') }}</p>
                                @endif                            
                              </div>
                            <div class="form-group">
                                <!-- Email address input-->
                                <input class="form-control" name="email" value="{{ old('email') }}" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
                                @if ($errors->has('email'))
                                  <p class="error-message">{{ $errors->first('email') }}</p>
                                @endif                           
                             </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <!-- Message input-->
                                <textarea class="form-control" name="message" placeholder="Your Message *" data-sb-validations="required">{{ old('message') }}</textarea>
                                @if ($errors->has('body'))
                                  <p class="error-message">{{ $errors->first('body') }}</p>
                                @endif                            
                            </div>
                        </div>
                    </div>
                    <!-- Submit success message-->
                    <!-- Submit Button-->
                    <div class="text-center"><button class="btn btn-primary" id="submitButton" type="submit">Send Message</button></div>
                </form>
            </div>
          </form>
        </section>


  </div>
@endsection