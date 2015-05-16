
    <div class="header navbar navbar-inverse navbar-fixed-top">
        <!-- BEGIN TOP NAVIGATION BAR -->
        <div class="navbar-inner">
            <div class="container-fluid">
                <!-- BEGIN LOGO -->
                <a class="brand" href="/">
                    <h2>Monitoring</h2>
                </a>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                    <img src="{{ asset('public/assets/img/menu-toggler.png') }}" alt="" />
                </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <ul class="nav pull-right">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <li class="dropdown" id="header_notification_bar">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                            <span class="badge">{{$ind}}</span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <li>
                                <p>У вас {{$ind}} уведомлений</p>
                            </li>
                            @foreach($notification as $not)
                                <li data-id="1">
                                    <a href="/static-{{$not->indeficator}}">
                                        <span class="label label-important"><i class="icon-bolt"></i></span>
                                        {{$not->descriptions}} http://web-sellers.ru/<br>
                                        <span class="time">{{$not->date_notification}}</span>
                                    </a>
                                    <i class="fa fa-times" onclick="deletNot({{$not->indeficator}})" ></i>
                                </li>
                            @endforeach
                            <li class="external">
                                <a href="/web">Все сайты <i class="m-icon-swapright"></i></a>
                            </li>
                        </ul>
                    </li>
                    <!-- END TODO DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img alt="" class="img-circle" src="{{ asset('public/assets/img/avatar1_small.jpg') }}" />
                            <span class="username">{{$name}}</span>
                            <i class="icon-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/profile"><i class="icon-user"></i> Мой профиль</a></li>
                            <li><a href="/my-calendar"><i class="icon-calendar"></i> Мой календарь</a></li>
                            <li class="divider"></li>
                            <li><a href="/auth/logout"><i class="icon-key"></i>Выйти</a></li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
                <!-- END TOP NAVIGATION MENU -->
            </div>
        </div>
        <!-- END TOP NAVIGATION BAR -->
    </div>