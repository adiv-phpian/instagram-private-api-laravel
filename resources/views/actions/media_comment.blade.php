@extends('layouts.ig_app')

@section('title', 'Request for comment')

@section('content')

<style>
#list ul{
  list-style-type: none;
  margin: 0;
  padding: 0;
}

li{
  display: inline;
}

.row{
  border: 1px solid #d0d0d0;
}
</style>

<div class="wrapper" style="margin-top: 100px;">

<div class="section profile-content">
    <div class="container">
       <div class="typography-line">
              <h4>
                 Get comments for
              </h4>
       </div>
        <div class="owner">
            <div class="avatar">
                <img src="{{ $user->profile_pic_url }}" alt="Circle Image" class="img-circle img-no-padding img-responsive" width="40%"> &nbsp; {{ $user->full_name }}
            </div>
        </div>

        <br/>
        <div class="row col-md-12 ml-auto mr-auto" id="medias">
          <div class="col-lg-3 col-md-4 col-xs-6">
            <img class="img-fluid img-thumbnail" src="{{ $image }}" style="height:200px;">
            <br>{{ $like_count }} Likes &nbsp; {{ $comment_count }} Comments
          </div>

          <div class="col-lg-4 col-md-4 col-xs-6">
            @if($max_count < 1)
               <h4> You can't request comments for this media. Please try again after some time. </h4>
            @else
              <form action="/comments/start" method="post">
                <div class="form-group">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="media_id" value=" {{ $id }} ">
                  <label for="no_of_follower">Number of comments: <br>(Available likes: {{ $max_count }})</label>
                  <input type="number" class="form-control" name="count" id="no_of_follower" max="{{ $max_count }}" value="1" min="1" max="10" required>

                  <label for="comment">Comment:</label>

                  <input type="text" class="form-control" name="comment" id="comment" required>
                  </div>
                  <button type="submit" class="btn btn-default">Submit</button>
              </form>
            @endif
          </div>
          </div>
        <!-- Tab panes -->

    </div>
</div>

@endsection

@section('script')


@endsection
