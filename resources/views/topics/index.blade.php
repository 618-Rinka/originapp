@extends('layouts.app')


@section('content')
  <div class="container">
    <section class="page-section">
      <div class="container">
          <div class="text-center">
              <h2 class="section-heading text-uppercase">Topic List</h2>
          </div> 

          <h3>検索</h3>
          <form action="" method="GET">
            <p>
              <input type="text" name="keyword" value="{{ request()->keyword ?? '' }}">
              <input type="submit" value="検索">
            </p>
          </form>
<<<<<<< HEAD

=======
          
>>>>>>> a1ecf78833055f938e3e54967d9b93037fa4e73f
          <div class="row">
            @foreach($topics as $topic)
              <div class="col-lg-4 col-sm-6 mb-4">
                @include('topics._topics_item', compact('topics'))
              </div>
            @endforeach
          </div>
          <div>
            {{ $topics->appends(request()->input())->links() }}
          </div>
      </section>
  </div>
<<<<<<< HEAD
@endsection 
=======
@endsection
>>>>>>> a1ecf78833055f938e3e54967d9b93037fa4e73f
