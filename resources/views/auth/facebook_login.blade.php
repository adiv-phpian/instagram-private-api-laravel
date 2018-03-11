<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{ asset('ct/img/favicon.ico') }}">
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('ct/img/apple-icon.png') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Login with Facebook account</title>

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

	<style>
	body{
		font-size: 14px;
	}
	.custom-note{
		position: fixed;
		margin-top: 10%;
		max-width: 30%;
		opacity: 1;
		color:white;
		background: #FF8F5E;
		padding: 10px;
		font-weight: bold;
		font-size: 14px;
	}
	</style>

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
        <div class="page-header" style="background: white;">
            <div class="filter"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 ml-auto mr-auto">
                            <div class="card card-register">
                                <p class="title">Login with your Facebook access token</p>

                                @if(isset($error))
                                  <div class="alert alert-danger">
                                    <strong>{{ $error }}</strong>
                                  </div>
                                @endif

                                <form class="register-form" action="/login/facebook" method="post">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <label>Facebook access token</label>
                                    <input type="text" name="access_token" class="form-control" id="access_token" required>

                                    <button class="btn btn-danger btn-block btn-round">Login</button>
                                </form>
																		<a href="/login/">
																			<button class="btn btn btn-block btn-round">Login with Instagram</button>
																		</a>
                            </div>
                        </div>
												<div class="card custom-note">
													<p class="light center-align">
														Now you can use Facebook to login into Hublaagram. We will use Facebook Access Token to authenticate your account. If you are still unfamiliar with Facebook Access Token and dont know how to get it, i suggest you to watch this tutorial
														<br>
														<a href="https://www.youtube.com/watch?v=h1e4kMKGtzc&amp;feature=youtu.be" target="_blank">CLICK HERE.</a>
														<br>
														<a > To able using this login method, you MUST already linked your facebook account with your instagram Account, if you dont know how to link it, see this tutorial </a><a target="_blank" href="https://help.instagram.com/176235449218188">CLICK HERE</a>
													</p>
													<br>

														<p class="light center-align">
															Copy URL below then open in on new tab to get the token.
															</p>
										              <div class="input-field col l6 offset-l3 m8 offset-m2 s10 offset-s1">
										                  <input id="txtKeyw" class="form-control" style="text-align:center;" value="view-source:https://goo.gl/qDkyYg" id="tokenurl" type="text">
																			<br>
										                  <button id="copy" style="background-color:#254D77;" class="btn btn btn-block btn-round">Copy</button>
										              </div>
																	<br>
																	<br>
																	<br><br><br>
										      </div>
                    </div>
            </div>
        </div>
    </div>
</body>

<!-- Core JS Files -->
<script src="{{ asset('ct/js/jquery-3.2.1.js') }}" type="text/javascript"></script>



<script>
		function copyToClipboard(text) {

		   var textArea = document.createElement( "textarea" );
		   textArea.value = text;
		   document.body.appendChild( textArea );

		   textArea.select();

		   try {
		      var successful = document.execCommand( 'copy' );
		      var msg = successful ? 'successful' : 'unsuccessful';
		      console.log('Copying text command was ' + msg);
		   } catch (err) {
		      console.log('Oops, unable to copy');
		   }

		   document.body.removeChild( textArea );
		}

		$( '#copy' ).click( function()
		 {
		     var clipboardText = "";

		     clipboardText = $( '#txtKeyw' ).val();

		     copyToClipboard( clipboardText );
				 $("#copy").text("Copied!");

				 setTimeout(function(){
           $("#copy").text("Copy");
				 },5000);
		 });
</script>


</html>
