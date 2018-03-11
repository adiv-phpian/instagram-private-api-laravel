@extends('layouts.ig_app')

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
              <h2>
                 Requests from
              </h2>
       </div>
        <div class="owner">
            <div class="avatar">
                <img src="{{ $user->profile_pic_url }}" alt="Circle Image" class="img-circle img-no-padding img-responsive" width="40%"> &nbsp; {{ $user->full_name }}
            </div>

        </div>

        <br/>
        <div class="nav-tabs-navigation">
          <div class="col-md-12 ml-auto mr-auto" id="medias">
            @if($queue->count() > 0)
            <table class="table">
               <thead> <th>Request type</th><th>count</th><th>Media id</th> <th>Comment</th></thead>

               @foreach($queue as $q)

               <tr><td>{{ $action[$q->action_id]  }}</td><td> {{ $q->count }} </td><td> {{ $q->media_id }} </td><td> {{ $q->comment }} </td></tr>

               @endforeach

           </table>
              @else
               <h2>No requests found</h2>
              @endif;
          </div>
        </div>
        <!-- Tab panes -->

    </div>

</div>

@endsection
