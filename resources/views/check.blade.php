@extends('app')

@section('content')

    <div class="container">
        <button type="button" id="loading-example-btn"  data-loading-text="Loading..." class="btn btn-primary btn-lg"
                onclick="check({{$countUrl}})" style="width: 100%;margin: 10px;">Проверить статус</button>
        <a id="removeUrl" href="/" class="btn  btn-lg" style="color:#ffffff;border-color:#9A2B2B;
        background-image: linear-gradient(to bottom, #CA4242 0, #B23434 100%); width: 100%;margin: 10px;">
            Перейти на главную и добавить ссылки?</a>
        <ul id="status">
            @foreach($good as $g)
                <li class="bg-success" style="margin: 10px; width: 100%;overflow: hidden;"><p  style="float: left; margin:0;">
                        Эта ссылка: {{$g->original_url}}<p style="float: right;margin:0;" @if($g->name === 'HTTP/1.1 302 Found')class="bg-danger" @endif>{{$g->name}}</p></li>
            @endforeach
        </ul>
    </div>
@endsection
