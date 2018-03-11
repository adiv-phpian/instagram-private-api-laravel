
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
	            <a class="navbar-brand" href="/">Instagram private API</a>
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
                                <h3 class="title">Small Verification</h3>

                                  <div class="alert alert-info">
                                    <strong>Please verify captcha before proceed</strong>
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


                                <form class="register-form" action="\verifycaptcha" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        {!! app('captcha')->display(['data-callback' => 'redirect']) !!}

                                    <input type="submit" name="send" class="btn btn-danger btn-block btn-round" value="Submit">
																</form>

                                </form>

                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</body>

<script src="{{ asset('ct/js/jquery-3.2.1.js') }}" type="text/javascript"></script>


<script>


</script>

</html>
