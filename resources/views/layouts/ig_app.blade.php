<html>
    <head>
      <meta charset="utf-8" />
      <link rel="icon" type="image/png" href="{{ asset('ct/img/favicon.ico') }}">
      <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('ct/img/apple-icon.png') }}">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

      <title>hublagram.xyz - @yield('title')</title>

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

      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-88387747-1"></script>
      <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-88387747-1');
      </script>


    </head>
    <body>
        @section('sidebar')
        <nav class="navbar navbar-expand-md bg-danger">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar-menu-icon" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                   </button>
                    <a class="navbar-brand" href="/">hublagram.xyz</a>
                    <div class="collapse navbar-collapse" id="navbar-menu-icon">
                        <ul class="navbar-nav ml-auto">

                            <li class="nav-item">
                                <a class="nav-link" href="/queue/view"><i class="nc-icon nc-basket" aria-hidden="true"></i> Requests</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/logout"><i class="nc-icon nc-refresh-69" aria-hidden="true"></i> Logout</a>
                            </li>

                        </ul>
                </div>
          </nav>

        @if(!isset($noadd))

        @show

        @if(Session::has('success'))
        <div class="alert alert-info col-md-8 ml-auto mr-auto">
          {{ Session('success') }}
        </div>
        @endif

        @if(Session::has('error'))
        <div class="alert alert-warning col-md-8 ml-auto mr-auto">
          {{ Session('error') }}
        </div>
        @endif

        @endif

        <div class="container">
            <div class="col-md-10 ml-auto mr-auto">
                @if(!isset($noadd))
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- links ads -->
                <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-8335960324729999"
                data-ad-slot="1617215463"
                data-ad-format="link"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                @endif
            </div>

            @yield('content')

            <div class="col-md-10 ml-auto mr-auto">
              @if(!isset($noadd))
              <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
              <!-- both -->
              <ins class="adsbygoogle"
              style="display:block"
              data-ad-client="ca-pub-8335960324729999"
              data-ad-slot="9746496664"
              data-ad-format="auto"></ins>
              <script>
              (adsbygoogle = window.adsbygoogle || []).push({});
              </script>
              @endif

              <!-- Core JS Files -->
              <script src="{{ asset('ct/js/jquery-3.2.1.js') }}" type="text/javascript"></script>
            </div>
        </div>



      </body>
      @yield('script')

      </html>
