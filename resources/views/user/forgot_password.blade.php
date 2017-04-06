<!DOCTYPE html>
<html class="login-content <!--[if IE 9 ]>ie9<![endif]-->">
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
            <div><img class="logo" src="/img/el/logo.png" name="Logo" /></div>
            <h1 class="c-white"><img class="ess-logo" src="/img/logo_small.png" name="EL" /> {{config('website.name')}}</h1>
        </div>
        <!-- Forgot Password -->
        <div class="lc-block toggled m-b-20" id="l-forgot-password">
            <h4>Oops, I forgot my password</h4>
            @include('session-message')
            <form method="POST" action="{{action('UserController@postForgotPassword')}}" id="forgot_password_form" name="forgot_password_form">
                {{csrf_field()}}
                <p class="text-left">We will send you a mail to reset your password.<br/>If you haven't received the mail, check
                    your spam box before retrying.</p>

                <div class="input-group m-b-20">
                    <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>

                    <div class="fg-line">
                        <input type="text" class="form-control" placeholder="Email Address" name="email" autofocus>
                    </div>
                </div>

                <div class="row text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-block btn-danger" type="submit">Reset Password</button>
                    </div>
                </div>
            </form>

            <div class="row m-t-30">
                <div class="col-xs-12 text-center">
                    <a href="{{action('UserController@login')}}" class="btn btn-default">Login</a>
                    <a href="{{action('UserController@register')}}" class="btn btn-default">Register</a>
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
                            <img src="/img/browsers/chrome.png" alt="">

                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="/img/browsers/firefox.png" alt="">

                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="/img/browsers/opera.png" alt="">

                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="/img/browsers/safari.png" alt="">

                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="/img/browsers/ie.png" alt="">

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