@extends('layouts.app')


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

                <h3>検索</h3>
                <form action="{{ route('topics.index') }}" method="GET"><p><input type="text" name="keyword" value="@if (isset($keyword)) {{ $keyword }} @endif">
                <input type="submit" value="検索"></p></form>
                
                <div class="row">
                  @foreach($topics as $topic)
                    <div class="col-lg-4 col-sm-6 mb-4">
                      @include('topics._topics_item', compact('topics'))
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
                                  <p class="error-message">{{ $errors->first('name') }}</p>
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
                                @if ($errors->has('message'))
                                  <p class="error-message">{{ $errors->first('message') }}</p>
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