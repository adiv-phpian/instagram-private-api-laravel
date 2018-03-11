

@extends('layouts.ig_app')
@section('title', 'Dashboard')
@section('content')

    <div class="wrapper" style="margin-top: 100px;">

		<div class="filter"></div>
		</div>
        <div class="section profile-content">
            <div class="container">
                <div class="owner">
                    <div class="avatar">
                        <img src="{{ $user->profile_pic_url }}" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                    </div>
                    <div class="name">
                        <h4 class="title">{{ $user->full_name }}<br /></h4>
						            <h6 class="description">{{ '@'.$user->username }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto text-center">
                         <div>{{ $user->media_count }} Media&nbsp; {{ $user->follower_count }} Followers&nbsp;  {{ $user->following_count}} Following</div>
                        <br />

                    </div>
                </div>
                <br/>
                <div class="nav-tabs-navigation">
									<div class="col-md-8 ml-auto mr-auto">
											<a href="/followers/start">
												<button type="button" class="btn btn-outline-danger btn-lg">Get Followers</button>
											</a>
											<a href="/likes/start">
											  <button type="button" class="btn btn-outline-danger btn-lg">Get Likes</button>
										  </a>
                      <a href="/comments/start">
											 <button type="button" class="btn btn-outline-danger btn-lg">Get Comments</button>
										  </a>
									</div>
                </div>
                <!-- Tab panes -->

            </div>
        </div>
    </div>

@endsection
