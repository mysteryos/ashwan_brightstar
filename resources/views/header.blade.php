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
                            <li>
                                <a data-action="clear-localstorage" href=""><i class="zmdi zmdi-delete"></i> Clear Local Storage</a>
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

        <aside id="chat">
            <ul class="tab-nav tn-justified" role="tablist">
                <li role="presentation" class="active"><a href="#friends" aria-controls="friends" role="tab" data-toggle="tab">Friends</a></li>
                <li role="presentation"><a href="#online" aria-controls="online" role="tab" data-toggle="tab">Online Now</a></li>
            </ul>

            <div class="chat-search">
                <div class="fg-line">
                    <input type="text" class="form-control" placeholder="Search People">
                </div>
            </div>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="friends">
                    <div class="listview">
                        <a class="lv-item" href="">
                            <div class="media">
                                <div class="pull-left p-relative">
                                    <img class="lv-img-sm" src="/img/profile-pics/2.jpg" alt="">
                                    <i class="chat-status-busy"></i>
                                </div>
                                <div class="media-body">
                                    <div class="lv-title">Jonathan Morris</div>
                                    <small class="lv-small">Available</small>
                                </div>
                            </div>
                        </a>

                        <a class="lv-item" href="">
                            <div class="media">
                                <div class="pull-left">
                                    <img class="lv-img-sm" src="/img/profile-pics/1.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="lv-title">David Belle</div>
                                    <small class="lv-small">Last seen 3 hours ago</small>
                                </div>
                            </div>
                        </a>

                        <a class="lv-item" href="">
                            <div class="media">
                                <div class="pull-left p-relative">
                                    <img class="lv-img-sm" src="/img/profile-pics/3.jpg" alt="">
                                    <i class="chat-status-online"></i>
                                </div>
                                <div class="media-body">
                                    <div class="lv-title">Fredric Mitchell Jr.</div>
                                    <small class="lv-small">Availble</small>
                                </div>
                            </div>
                        </a>

                        <a class="lv-item" href="">
                            <div class="media">
                                <div class="pull-left p-relative">
                                    <img class="lv-img-sm" src="/img/profile-pics/4.jpg" alt="">
                                    <i class="chat-status-online"></i>
                                </div>
                                <div class="media-body">
                                    <div class="lv-title">Glenn Jecobs</div>
                                    <small class="lv-small">Availble</small>
                                </div>
                            </div>
                        </a>

                        <a class="lv-item" href="">
                            <div class="media">
                                <div class="pull-left">
                                    <img class="lv-img-sm" src="/img/profile-pics/5.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="lv-title">Bill Phillips</div>
                                    <small class="lv-small">Last seen 3 days ago</small>
                                </div>
                            </div>
                        </a>

                        <a class="lv-item" href="">
                            <div class="media">
                                <div class="pull-left">
                                    <img class="lv-img-sm" src="/img/profile-pics/6.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="lv-title">Wendy Mitchell</div>
                                    <small class="lv-small">Last seen 2 minutes ago</small>
                                </div>
                            </div>
                        </a>
                        <a class="lv-item" href="">
                            <div class="media">
                                <div class="pull-left p-relative">
                                    <img class="lv-img-sm" src="/img/profile-pics/7.jpg" alt="">
                                    <i class="chat-status-busy"></i>
                                </div>
                                <div class="media-body">
                                    <div class="lv-title">Teena Bell Ann</div>
                                    <small class="lv-small">Busy</small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="online">
                    <div class="listview">
                        <a class="lv-item" href="">
                            <div class="media">
                                <div class="pull-left p-relative">
                                    <img class="lv-img-sm" src="/img/profile-pics/2.jpg" alt="">
                                    <i class="chat-status-busy"></i>
                                </div>
                                <div class="media-body">
                                    <div class="lv-title">Jonathan Morris</div>
                                    <small class="lv-small">Available</small>
                                </div>
                            </div>
                        </a>

                        <a class="lv-item" href="">
                            <div class="media">
                                <div class="pull-left p-relative">
                                    <img class="lv-img-sm" src="/img/profile-pics/3.jpg" alt="">
                                    <i class="chat-status-online"></i>
                                </div>
                                <div class="media-body">
                                    <div class="lv-title">Fredric Mitchell Jr.</div>
                                    <small class="lv-small">Availble</small>
                                </div>
                            </div>
                        </a>

                        <a class="lv-item" href="">
                            <div class="media">
                                <div class="pull-left p-relative">
                                    <img class="lv-img-sm" src="/img/profile-pics/4.jpg" alt="">
                                    <i class="chat-status-online"></i>
                                </div>
                                <div class="media-body">
                                    <div class="lv-title">Glenn Jecobs</div>
                                    <small class="lv-small">Availble</small>
                                </div>
                            </div>
                        </a>

                        <a class="lv-item" href="">
                            <div class="media">
                                <div class="pull-left p-relative">
                                    <img class="lv-img-sm" src="/img/profile-pics/7.jpg" alt="">
                                    <i class="chat-status-busy"></i>
                                </div>
                                <div class="media-body">
                                    <div class="lv-title">Teena Bell Ann</div>
                                    <small class="lv-small">Busy</small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </aside>
    </section>

    <section id="content">
        @include('session-message')