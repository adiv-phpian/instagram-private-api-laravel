<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{ asset('ct/img/favicon.ico') }}">
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('ct/img/apple-icon.png') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Challenge for instagram login</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<!-- Bootstrap core CSS     -->
	<link href="{{ asset('ct/css/bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('ct/css/paper-kit.css?v=2.1.0') }}" rel="stylesheet"/>

	<!--  CSS for Demo Purpose, don't include it in your project     -->
	<link href="{{ asset('ct/css/demo.css') }}" rel="stylesheet" />

    <!--     Fonts and icons     -->
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link href="{{ asset('ct/css/nucleo-icons.css') }}" rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-expand-md fixed-top navbar-transparent">
        <div class="container">
			<div class="navbar-translate">
	            <button class="navbar-toggler navbar-toggler-right navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-bar"></span>
					<span class="navbar-toggler-bar"></span>
					<span class="navbar-toggler-bar"></span>
	            </button>
	            <a class="navbar-brand" href="/">hublagram.xyz</a>
			</div>

		</div>
    </nav>
    <div class="wrapper">
        <div class="page-header" style="background-image: url(' {{ asset('ct/img/login-image.jpg') }} ');">
            <div class="filter"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 ml-auto mr-auto">
                            <div class="card card-register">
                                <h3 class="title">Instagram Challenge for new login</h3>

                                  <div class="alert alert-info">
                                    <strong>{{ $method->value == 3 ? 'Enter your facebook access token' : 'Verification code has been sent to '.$method->label  }} </strong>
                                  </div>

																	@if(isset($error))

																	<div class="alert alert-danger">
																		<strong>{{ $error }}</strong>
																	</div>

																	@endif

																	@if(isset($success))

																	<div class="alert alert-success">
																		<strong>{{ $sucess }}</strong>
																	</div>

																	@endif


                                <form class="register-form" action="\login-challenge" method="post">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
																	<input type="hidden" name="pass" value="{{ $pass }}">
																	<input type="hidden" name="insta" value="{{ $insta }}">
																	<input type="hidden" name="url" value="{{ $url }}">
																	<input type="hidden" name="method" value="{{ $method->value }}">
																	<input type="hidden" name="method_obj" value="{{ json_encode($method) }}">
																	<input type="hidden" name="url_obj" value="{{ json_encode($response) }}">

																		<label>Verification code</label>
                                    <input type="text" name="code" class="form-control" id="code" required >

                                    <button name="send" value="1" class="btn btn-danger btn-block btn-round">Submit</button>
																</form>

																		<form class="register-form" action="\login-rechallenge" method="post">
																			<input type="hidden" name="_token" value="{{ csrf_token() }}">
																			<input type="hidden" name="pass" value="{{ $pass }}">
																			<input type="hidden" name="method_obj" value="{{ json_encode($method) }}">
																			<input type="hidden" name="insta" value="{{ $insta }}">
																			<input type="hidden" name="method" value="{{ $method->value }}">
																			<input type="hidden" name="url" value="{{ $url }}">
																			<input type="hidden" name="url_obj" value="{{ json_encode($response) }}">
																		  <button name="resend" value="1" class="btn btn-danger btn-block btn-round">Resend code</button>
																	  </form>

                                </form>

                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</body>

<!-- Core JS Files -->
<script src="{{ asset('ct/js/jquery-3.2.1.js') }}" type="text/javascript"></script>
<script src="{{ asset('ct/js/jquery-ui-1.12.1.custom.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ct/js/tether.min.js" type="text/javascript') }}"></script>
<script src="{{ asset('ct/js/bootstrap.min.js') }}" type="text/javascript"></script>

<!--  Paper Kit Initialization snd functons -->
<script src="{{ asset('ct/js/paper-kit.js?v=2.0.1') }}"></script>

</html>
