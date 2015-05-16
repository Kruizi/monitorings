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
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <!-- BEGIN PAGE CONTAINER-->
            <div class="container-fluid">
                <!-- BEGIN PAGE HEADER-->
                <div class="row-fluid">
                    <div class="span12">
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                <div id="dashboard">
                    <!-- BEGIN DASHBOARD STATS -->
                    <div class="row-fluid">
                        @foreach($client as $clin)
                            <div class="span3 responsive" data-tablet="span6" data-desktop="span3">
                                <div class="dashboard-stat
                                    @if($clin->status == '0')
                                        green
                                    @elseif($clin->status == '1')
                                        yellow
                                    @else
                                        red
                                    @endif ">
                                    <div class="details">
                                        <div class="desc">
                                            {{$clin->name_clients}}
                                        </div>
                                    </div>
                                    <a class="more" href="/static-{{$clin->indeficators}}">
                                        Просмотреть статистику <i class="m-icon-swapright m-icon-white"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>
    <!-- END CONTAINER -->


@endsection
