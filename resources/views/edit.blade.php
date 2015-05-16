@extends('appHome')

@section('contentHome')
    <!-- BEGIN BODY -->
    <body class="fixed-top">
    <!-- BEGIN HEADER -->
    @include('header')
    <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
        <!-- BEGIN SIDEBAR -->
        @include('menu')
        <!-- END SIDEBAR -->
        <!-- BEGIN PAGE -->
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div id="portlet-config" class="modal hide">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button"></button>
                    <h3>Widget Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here will be a configuration form</p>
                </div>
            </div>
            <script>
            /*
                var code_error = '{{$dd["code_error"]}}';
                var desc_error = '{{$dd["desc_error"]}}';
                var accessibility = '{{$dd["accessibility"]}}';
                alert('Отчет робота: '+code_error+' \n Что нужно предпринять, если есть ошибка : '+desc_error+'\n Номер ошибки: '+accessibility);
            */
            </script>
            <input type="hidden" name="csrf-token" value="{{ csrf_token() }}" />
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <!-- BEGIN PAGE CONTAINER-->
            <div class="container-fluid">
                <!-- BEGIN PAGE HEADER-->
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                        <h3 class="page-title">
                            Статистика вашего сайта
                        </h3>
                        <ul class="breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="/">Главная</a>
                                <i class="fa fa-arrow-circle-o-right"></i>
                            </li>
                            <li><a href="#">Статистика сайта: {{$get_client->web_clients}}</a></li>
                            <li class="pull-right no-text-shadow">
                                <div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" data-tablet="" data-desktop="tooltips" data-placement="top" data-original-title="Change dashboard date range">
                                    <i class="icon-calendar"></i>
                                    <span></span>
                                    <i class="icon-angle-down"></i>
                                </div>
                            </li>
                        </ul>
                        <div class="row">
                          <div class="col-md-4" style="float: left;"><img src="/public/sceenshots/{{$get_client->name_clients}}.png" /></div>
                          <table class="table table-hover" style="width:63.6%;float: left;">
                            <thead>
                                <tr>
                                  <th>Сайт доступен ?</th>
                                  <th>Время соединение с сайтом ?</th>
                                  <th>За какое время загрузилась страница ?</th>
                                  <th>Размер страницы ?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                            <td class="info">@if($dd['accessibility'] >= '200' AND $dd['accessibility'] <= '300')
                                    <b style="color: green;">Доступен</b>
                                @else
                                    <b style="color: red;">Недоступен</b>
                                @endif</td>
                            <td class="info"><b>{{$dd['coonect_time']}} секунд</b></td>
                            <td class="info"><b>{{$dd['speed_download']}} секунд</b></td>
                            <td class="info"><b>{{$dd['size_page']}}</b></td>
                                </tr>
                            </tbody>
                          </table>
                          <h3 style="text-align: center;">Доступность сайта</h3>
                          <div style="height: 250px;width: 63.3%;float:left;">
			                 <form class="form-horizontal">
		                          <div class="input-prepend">
                                        <input type="text" name="range" id="range" />
		                          </div>
			                 </form>
                    			<div id="placeholder">
				                    <figure id="chart"></figure>
			                     </div>
                          </div>
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        </div>
                        <div class="content">
                            <h3>Полная статистика сайта</h3>
                            <div class="bs-example" data="images">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Название страницы</th>
                                  <th>Название изображения</th>
                                  <th>Ссылка на изображения</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach($img as $i)
                                  @if($i == 400)
                                    <tr>
                                      <td>1</td>
                                      <td>Одежда</td>
                                      <td>images.png</td>
                                      <td>{{$get_client->web_clients}}{{$i[web]}}</td>
                                      <td><img width="150" height="150" src="{{$get_client->web_clients}}{{$i[web]}}" /></td>
                                    </tr>
                                  @endif
                              @endforeach  
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- END PAGE TITLE & BREADCRUMB-->
                        
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>
<style>

/*----------------------------
	The Chart
-----------------------------*/


#placeholder {
  width: 695.031px;
  margin: 0px;
}
#content {
	margin: 0px auto;
	padding: 45px;
	position: relative;
	width: 590px;
}

#chart{
	width: 100%;
	height: 300px;
  margin: 0px;
}

.ex-tooltip{
	position: absolute;
	background: #EEE;
	border-radius: 3px;
	border-radius: 3px;
	padding: 5px;
	box-shadow: 0 1px 3px black;
	box-shadow: 0 1px 3px black;
	border-collapse: separate;
	display: none;
}
form.form-horizontal {
  position: absolute;
  right: 30px;
}

</style>
		<!-- xcharts includes -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/d3/2.10.0/d3.v2.js"></script>
		<script src="public/assets/js/xcharts.min.js"></script>

		<!-- The daterange picker bootstrap plugin -->
		<script src="public/assets/js/sugar.min.js"></script>
		<script src="public/assets/js/daterangepicker.js"></script>

		<!-- Our main script file -->
		<script src="public/assets/js/script.js"></script>
    <!-- END CONTAINER -->


@endsection
