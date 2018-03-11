@extends('layouts.ig_app')

@section('title', 'Request for follows')


@section('content')

<div class="wrapper" style="margin-top: 100px;">

<div class="section profile-content">
    <div class="container">
       <div class="typography-line">
              <h4
                 Get followers for
              </h4>
       </div>
        <div class="owner">
            <div class="avatar">
                <img src="{{ $user->profile_pic_url }}" alt="Circle Image" class="img-circle img-no-padding img-responsive" width="40%"> &nbsp; {{ $user->full_name }}
            </div>

        </div>

        <br/>
        <div class="nav-tabs-navigation">
          <div class="col-md-6 ml-auto mr-auto">

                @if($max_count < 1)
                   <h4> We don't have enough users to follow you. You can't request for followers right now. You can try after some time.</h4>

                @elseif($timepause == true)
                   <h4> You can't request for followers right now. You can try after {{ $after_time }} minutes </h4>
                @else

                <form action="/followers/start" method="post">
                  <div class="form-group">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <label for="no_of_follower">Number of followers: <br>(Available followers: {{ $max_count }})</label>
                    <input type="number" class="form-control" name="count" id="no_of_follower" max="{{ $max_count }}" value="1" min="1" >
                  </div>
                  <button type="submit" class="btn btn-default">Submit</button>
                </form>
                @endif

                <br>
                <br>

                Last request {{ $last_request }}

          </div>
        </div>
        <!-- Tab panes -->

    </div>

</div>


@endsection
