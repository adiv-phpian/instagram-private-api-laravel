
@extends('layouts.ig_app')
@section('title', 'Get more followers by upgrade your account or download Android or IOS application')
@section('content')

    <div class="wrapper" style="margin-top: 100px;">

		<div class="filter"></div>
		</div>
        <div class="section profile-content">
            <div class="container">


                <div class="row">
                  @if(Session::has('success'))
                  <div class="alert alert-info col-md-8 ml-auto mr-auto" style="font-size: 25px;">
                    {{ Session('success') }}
                  </div>
                  @endif
      						<div class="col-md-8 ml-auto mr-auto text-center">
      							<h2 class="title">You want more likes, comments and Followers</h2>
      							<p class="description" style="font-size: 25px;">Contact us or download the android or ios app for free</p>
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
