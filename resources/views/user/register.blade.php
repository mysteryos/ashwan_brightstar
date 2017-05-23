<!DOCTYPE html>
<!--[if IE 9 ]>
<html class="ie9"><![endif]-->
<html class="login-content">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$websiteName.' - '.$pageTitle}}</title>

    <link rel="shortcut icon" href="/favicon.ico" />
    @foreach($css as $css_file)
        <link href="{{$css_file}}" rel="stylesheet" />
    @endforeach
</head>

<body class="login-content">
    <div class="text-center">
        <h1 class="c-white"><img class="ess-logo" src="/img/logo_small.png" name="EL" /> {{config('website.name')}}</h1>
    </div>
    <!-- Register -->
    <div class="lc-block toggled m-b-20" id="l-register">
        <h4>Register your account</h4>
        @include('session-message')
        <form method="POST" action="{{action('UserController@postRegister')}}" id="register_form" name="register_form">
            {{csrf_field()}}
            <div class="input-group m-b-20">
                <span class="input-group-addon"><i class="zmdi zmdi-comment-text-alt"></i></span>

                <div class="fg-line">
                    <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{old('first_name')}}" autofocus>
                </div>
            </div>

            <div class="input-group m-b-20">
                <span class="input-group-addon"><i class="zmdi zmdi-comment-text-alt"></i></span>

                <div class="fg-line">
                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{old('last_name')}}">
                </div>
            </div>

            <div class="input-group m-b-20">
                <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>

                <div class="fg-line">
                    <input type="text" name="email" class="form-control" placeholder="Email Address" value="{{old('email')}}">
                </div>
            </div>

            <div class="input-group m-b-20">
                <span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>

                <div class="fg-line">
                    <input type="password" name="password" class="form-control" placeholder="Password" value="" autocomplete="off" id="input_password">
                </div>
                <div class="progress m-l-10 m-r-10" style="display:none;" id="password_strength">
                    <div class="progress-bar progressbar-danger" style="width: 0%" id="password_progressbar"></div>
                </div>
                <div id="password_strength_container" style="display:none;">Password Strength: <span id="password_strength_text"></span></div>
            </div>

            <div class="clearfix"></div>

            <div class="checkbox input-group">
                <label>
                    <input type="checkbox" value="1" name="accept_agreement">
                    <i class="input-helper"></i>
                    Accept the <a href="{{action('UserController@licenseAgreement')}}" target="_blank">terms & conditions</a>
                </label>
            </div>

            <div class="row text-center m-t-20">
                <div class="col-xs-12">
                    <button class="btn btn-block btn-danger" type="submit">Register</button>
                </div>
            </div>
        </form>

        <div class="row m-t-30">
            <div class="col-xs-12 text-center">
                <a href="{{action('UserController@login')}}" class="btn btn-default">Login</a>
                <a href="{{action('UserController@forgotPassword')}}" class="btn btn-default">Forgot Password</a>
            </div>
        </div>
    </div>

    <!-- Older IE warning message -->
    <!--[if lt IE 9]>
    <div class="ie-warning">
        <h1 class="c-white">Warning!!</h1>

        <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers
            to access this website.</p>

        <div class="iew-container">
            <ul class="iew-download">
                <li>
                    <a href="http://www.google.com/chrome/">
                        <img src="img/browsers/chrome.png" alt="">

                        <div>Chrome</div>
                    </a>
                </li>
                <li>
                    <a href="https://www.mozilla.org/en-US/firefox/new/">
                        <img src="img/browsers/firefox.png" alt="">

                        <div>Firefox</div>
                    </a>
                </li>
                <li>
                    <a href="http://www.opera.com">
                        <img src="img/browsers/opera.png" alt="">

                        <div>Opera</div>
                    </a>
                </li>
                <li>
                    <a href="https://www.apple.com/safari/">
                        <img src="img/browsers/safari.png" alt="">

                        <div>Safari</div>
                    </a>
                </li>
                <li>
                    <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                        <img src="img/browsers/ie.png" alt="">

                        <div>IE (New)</div>
                    </a>
                </li>
            </ul>
        </div>
        <p>Sorry for the inconvenience!</p>
    </div>
    <![endif]-->

    @foreach($js as $js_file)
        <script src='{{$js_file}}'></script>
    @endforeach

    <!-- Placeholder for IE9 -->
    <!--[if IE 9 ]>
    <script src="/vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
    <![endif]-->


    </body>
</html>