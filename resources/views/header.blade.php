<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$websiteName.' - '.$pageTitle}}</title>

    <link rel="shortcut icon" href="/favicon.ico" />
    @foreach($css as $css_file)
        <link href="{{$css_file}}" rel="stylesheet" />
    @endforeach

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
                <a href="/"><img src="{{asset('/img/logo_tiny.png')}}" class="m-r-5 hidden-xs"/>BrightStar E-Learning</a>
            </li>

            <li class="pull-right">
                <ul class="top-menu">
                    <li id="toggle-width">
                        <div class="toggle-switch">
                            <input id="tw-switch" type="checkbox" hidden="hidden">
                            <label for="tw-switch" class="ts-helper"></label>
                        </div>
                    </li>
                    <li class="dropdown" id="menu_header_shortcut">
                        <a data-toggle="dropdown" class="tm-settings" href=""></a>
                        <ul class="dropdown-menu dm-icon pull-right">
                            <li class="hidden-xs">
                                <a data-action="fullscreen" href=""><i class="zmdi zmdi-fullscreen"></i> Toggle Fullscreen</a>
                            </li>
                            @if(session('login_as',false))
                                <li>
                                    <a href="{{action('Admin\UsersController@getLoginBack')}}"><i class="zmdi zmdi-refresh-sync"></i> Login Back</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{action('UserController@logout')}}" title="Logout"><i class="zmdi zmdi-square-right"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Top Search Content -->
        <div id="top-search-wrap">
            <input type="text">
            <i id="top-search-close">&times;</i>
        </div>
    </header>

    <section id="main">
        <!-- Aside Menu goes here -->
        @include('menu')
    </section>

    <section id="content">
        @include('session-message')