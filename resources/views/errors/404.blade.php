<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BrightStar E-Learning - 404 not found</title>

    <link href="/css/app.min.1.css" rel="stylesheet" />
    <link href="/css/app.min.2.css" rel="stylesheet" />
    <link href="/css/el/404.css" rel="stylesheet" />

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
    <div class="row">
        <div class="col-xs-12 text-center" style="" id="container">
            <img src="{{asset('/img/error_404.jpg')}}" class="img-responsive" />
        </div>
    </div>
    <div class="row">
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