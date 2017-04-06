<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BrightStar E-Learning - 500 Internal Server Error</title>

    <link href="/css/app.min.1.css" rel="stylesheet" />
    <link href="/css/app.min.2.css" rel="stylesheet" />
    <link href="/css/el/500.css" rel="stylesheet" />

</head>
<body class="toggled sw-toggled">
    <header id="header">
        <ul class="header-inner">
            <li id="menu-trigger" data-trigger="#sidebar">
                <div class="line-wrap">
                    <div class="line top"></div>
                    <div class="line center"></div>
                    <div class="line bottom"></div>
                </div>
            </li>

            <li class="logo">
                <a href="/">BrightStar E-Learning</a>
            </li>
        </ul>
    </header>
    <div class="row m-t-20">
        <div class="col-md-8 text-center p-20">
            <h1 class="c-red">500 - Internal Server Error</h1>
            <h2>Even the things we love breaks sometimes</h2>
            <h4>Thanks for your patience while we put things back together.</h4>
            <p>In the meantime, you can...</p>
            <ul class="list-unstyled">
                <li>- Contact your administrator if the error persists</li>
                <li>- Retry your last action</li>
            </ul>
        </div>
        <div class="col-md-4 p-20 text-center hidden-xs">
            <img src="{{asset('/img/error_500.png')}}" class="img-responsive" id="img_500" />
        </div>
    </div>
    <div class="row m-t-20">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
            <div class="card">
                <div class="card-body card-padding text-center">
                    <a class="btn btn-link c-blue" href="{{\URL::previous()}}">Return to previous page</a>
                    <a class="btn btn-link c-green m-r-10" href="/">Back to home page</a>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <script type="text/javascript" src='/vendors/bower_components/jquery/dist/jquery.js'></script>
        <script type="text/javascript" src='/vendors/bower_components/Waves/dist/waves.js'></script>
        <script type="text/javascript" src='/js/functions.js'></script>
    </footer>
</body>