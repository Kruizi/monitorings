@extends('app')

@section('content')
    <body class="login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <img src="{{ asset('public/assets/img/logo-big.png') }}" alt="logo" />
        </div>
        <!-- END LOGO -->

    <div class="content">
        <form class="form-vertical login-form" role="form" method="POST" action="{{ url('/auth/login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    Произошла ошибка.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h3 class="form-title">Вход в панель!</h3>
            <div class="alert alert-error hide">
                <button class="close" data-dismiss="alert"></button>
                <span>Enter any username and passowrd.</span>
            </div>
            <div class="control-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Username</label>
                <div class="controls">
                    <div class="input-icon left">
                        <i class="icon-user"></i>
                        <input type="email" autocomplete="on" class="m-wrap placeholder-no-fix" placeholder="Введите почтовый адрес" name="email" value="{{ old('email') }}">
                    </div>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="controls">
                    <div class="input-icon left">
                        <i class="icon-lock"></i>
                        <input type="password" autocomplete="off" class="m-wrap placeholder-no-fix" placeholder="Введите ваш пароль" name="password">
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn green pull-right">
                    Вход <i class="m-icon-swapright m-icon-white"></i>
                </button>
            </div>
            <div class="forget-password">
                <h4>Забыли пароль?</h4>
                <p>
                    для того чтобы восстановить пароль, нажмите <a href="{{ url('/password/email') }}" >сюда</a>
                    и восстановите пароль.
                </p>
            </div>
            <!---<div class="create-account">
                <p>
                     ?&nbsp;
                    <a href="javascript:;" id="register-btn" class="">Create an account</a>
                </p>
            </div>--->
        </form>
    </div>
@endsection
