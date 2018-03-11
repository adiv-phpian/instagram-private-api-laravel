@extends('layouts.ig_app')

@section('title', 'Request for likes')


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

.loadmore{
  max-height: 10%;
  width: 100%;
}
</style>

<div class="wrapper" style="margin-top: 100px;">

<div class="section profile-content">
    <div class="container">
       <div class="typography-line">
              <h4>
                 Get likes for
              </h4>
       </div>


        <div class="owner">
            <div class="avatar">
                <img src="{{ $user->profile_pic_url }}" alt="Circle Image" class="img-circle img-no-padding img-responsive" width="40%"> &nbsp; {{ $user->full_name }}
            </div>
        </div>

        <br/>

        @if($timepause == true)
           <div class="col-md-6 ml-auto mr-auto">
           <h4> You can't request for followers right now. You can try after {{ $after_time }} minutes </h4>
           <br>
           <br>

           Last request {{ $last_request }}

          </div>

        @else
        <div class="row text-center text-lg-left" id="medias">
          <div class="col-md-12 ml-auto mr-auto" >
           <div id="spinner" style="text-align:center;font-size: 12px;"><h2>Loading....</h2></div>
          </div>
        </div>
        <!-- Tab panes -->
        @endif;

    </div>
</div>

@endsection

@if($timepause == false)

@section('script')

<script>
  var csrf = "{{ csrf_token() }}";
  var next_id = 0;
  $('#spinner').show();

  $(function(){

    loadmore(0);

    $(document).on('click', "[id^='loadmore__']", function(){
       var id = this.id.split("__")[1];
       $(this).remove();
       $('#spinner').show();
       loadmore(id);
    });

  });

  function loadmore(next_id){

    var post = $.post('/media/get', {_token : csrf, next_id : next_id});

    post.done(function(data){
      $('#spinner').hide();

      var html = "";

      if(data.code == 300){
        html += '<div class="col-lg-3 col-md-4 col-xs-6" style="color:red;padding: 5px; border: px solid red;">Something went wrong, Try again.</div>';
        $("#medias").append(html);
        return false;
      }


      var id = "";

      if(data.items.length == 0){
        html += '<div class="col-lg-3 col-md-4 col-xs-6">No media found</div>';
        $("#medias").append(html);
        return false;
      }

      $.each(data.items, function(k, item){

        var image = item.image_versions2.candidates[0].url;
        id = item.id;

        html += '<div class="col-lg-3 col-md-4 col-xs-6">'+
        '<a href="#" class="d-block ">'+
        '<img class="img-fluid img-thumbnail" src="'+image+'" style="height:200px;"><br>'+ item.like_count +' Likes &nbsp; '+ item.comment_count +' Comments<br>'+
        '<form action="/likes/media" method="post">'+
         '<div class="form-group">'+
         '<input type="hidden" name="_token" value="'+csrf+'">'+
         '<input type="hidden" name="id" value="'+id+'">'+
         '<input type="hidden" name="url" value="'+image+'">'+
         '<input type="hidden" name="like_count" value="'+item.like_count+'">'+
         '<input type="hidden" name="comment_count" value="'+item.comment_count+'">'+
         '<button type="submit" class="btn btn-default">Submit</button>'+
         '</div></form></a>'+
        '</div>';

        /*html += '<div class="col-md-6 "><form action="/likes/start" method="post">'+
                 '<div class="form-group">'+
                 '<input type="hidden" name="_token" value="'+csrf+'">'+
                 '<input type="hidden" name="media_id" value="'+id+'">'+
                 '<label for="no_of_follower">Number of likes: <br>(Available likes: {{ $user_count-1 }})</label>'+
                 '<input type="number" class="form-control" name="count" id="no_of_follower" max="{{ $user_count-1 }}" value="1" min="1">'+
                 '</div>'+
                 '<button type="submit" class="btn btn-default">Submit</button>'+
                 '</form></div>';
        html += '</div>';*/

      });

      if(data.more_available == true) html += "<button class='loadmore btn btn-danger' id='loadmore__"+id+"'>Load more...</button>";

      $("#medias").append(html);

    });

  }

</script>

@endsection

@endif
