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

            <!-- BEGIN PAGE CONTAINER-->
            <div class="container-fluid">
                <!-- BEGIN PAGE HEADER-->
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="page-title">
                            Добавить новый сайт
                            <small>полная активация сайт произойдет после 5 часов</small>
                        </h3>
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->
                <script type="text/javascript" src="public/assets/jquery-validation/dist/jquery.validate.min.js"></script>
                <script type="text/javascript" src="public/assets/jquery-validation/dist/additional-methods.min.js"></script>
                <script src="public/assets/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
                <script>
                    jQuery(document).ready(function() {
                        App.setPage("form_validation");
                        App.init(); // init the rest of plugins and elements
                    });
                </script>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="portlet box blue" id="form_wizard_1">
                            <div class="portlet-title">
                                <h4>
                                    <i class="icon-reorder"></i> Форма клиента - <span class="step-title">Пункт 1 из 4</span>
                                </h4>
                            </div>
                            <div class="portlet-body form">
                                <form action="#" class="form-horizontal">
                                    <div class="form-wizard">
                                        <div class="navbar steps">
                                            <div class="navbar-inner">
                                                <ul class="row-fluid">
                                                    <li class="span3">
                                                        <a href="#tab1" data-toggle="tab" class="step active">
                                                            <span class="number">1</span>
                                                            <span class="desc"><i class="icon-ok"></i> Информация клиента</span>
                                                        </a>
                                                    </li>
                                                    <li class="span3">
                                                        <a href="#tab2" data-toggle="tab" class="step">
                                                            <span class="number">2</span>
                                                            <span class="desc"><i class="icon-ok"></i> Опции работы скрипта</span>
                                                        </a>
                                                    </li>
                                                    <li class="span3">
                                                        <a href="#tab3" data-toggle="tab" class="step">
                                                            <span class="number">3</span>
                                                            <span class="desc"><i class="icon-ok"></i> Настройка скрипта</span>
                                                        </a>
                                                    </li>
                                                    <li class="span3">
                                                        <a href="#tab4" data-toggle="tab" class="step">
                                                            <span class="number">4</span>
                                                            <span class="desc"><i class="icon-ok"></i> Скачивание файла</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div id="bar" class="progress progress-success progress-striped">
                                            <div class="bar"></div>
                                        </div>

                                        <div class="tab-content">
                                            <script>
                                                function checkeds(value,item){
                                                    if(value === ''){
                                                        $(item).css({border: "1px solid #EAA6A6"})
                                                    }else if(value != ''){
                                                        $(item).css({border: "1px solid #62C462"});
                                                    }
                                                    window.name_client = $('input[name="name_client"]').val();
                                                    window.web_client = $('input[name="web_client"]').val();
                                                    if($("#tab1").hasClass("active") == true){
                                                        if(name_client != '' && web_client != ''){
                                                            $('a.btn.blue.button-next').fadeIn();
                                                        }else{
                                                            $('a.btn.blue.button-next').fadeOut();
                                                        }
                                                    }else if($("#tab2").hasClass("active") == true){
                                                        $('a.btn.blue.button-next').fadeOut();

                                                    }
                                                }
                                            </script>
                                            <div class="tab-pane active" id="tab1">
                                                <h3 class="block">Добавление клиента для мониторинга</h3>

                                                <div class="control-group">
                                                    <label class="control-label">Имя клиента</label>
                                                    <div class="controls">
                                                        <input type="text" onblur="checkeds(value,this)" class="span6 m-wrap" name="name_client"  placeholder="Пример: Саломей"  />
                                                        <span class="help-inline">Поле обязательное для заполнение</span>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label">Сайт клиента</label>
                                                    <div class="controls">
                                                        <input type="text" onblur="checkeds(value,this)" class="span6 m-wrap" name="web_client" data-validation="email" placeholder="Пример: http://www.example.ru/" />
                                                        <span class="help-inline">Поле обязательное для заполнение</span>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="tab-pane" id="tab2">
                                                <h3 class="block">Это настройка функции javascript</h3>
                                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                                <script>
                                                    function randomInteger(min, max) {
                                                        var rand = min + Math.random() * (max - min)
                                                        rand = Math.round(rand);
                                                        return rand;
                                                    }
                                                    $(document).ready(function(){
                                                        $('a.btn.blue.button-next').fadeOut();
                                                        $('.btn.blue.button-next').click(function(){
                                                            window.valueAr= [];
                                                            window.inputValueAr = [];
                                                            window.valueArray = [];
                                                            $("#tab3").find(".control-group").each(function(){
                                                                valueAr.push(this.dataset.value);
                                                                valueArray.push(this.id);
                                                                inputValueAr.push(this.lastElementChild.lastElementChild.value);
                                                            });
                                                            if($("#tab4").hasClass("active") == true){
                                                                $('#name_client').attr('key','+').text(name_client);
                                                                $('#web_client').attr('key','+').text(web_client);
                                                                for (var i = 0; i < valueAr.length; i++) {
                                                                    $('#options').append('<span class="text">'+valueAr[i]+': <b>'+inputValueAr+'</b></span>');
                                                                    console.log(inputValueAr[i]);
                                                                }
                                                            }
                                                        });
                                                        $('#tan4').css({cursor: 'pointer'});
                                                        var _token = $('#token').val();
                                                        $('#form_wizard_1').find('.button-previous').hide();
                                                        $('#form_wizard_1 .button-submit').click(function () {
                                                            $.post('/java-script/', {
                                                                name_client: name_client,
                                                                web_client: web_client,
                                                                valueAr: valueArray,
                                                                inputValueAr: inputValueAr,
                                                                id: randomInteger(100000, 999999),
                                                                _token: _token
                                                            }, function(data) {
                                                                $('#tan4').css({opacity: '1'});
                                                                $('.control-group').fadeOut();
                                                                $('#isisubmit').fadeOut();
                                                                $('.btn.button-previous').fadeOut();
                                                                $('.form-actions.clearfix').fadeOut();
                                                                $('#tan4').text('<script type="text/javascript">\n' +
                                                                'window.onload = function() {' +
                                                                '(function(){ var s = document.createElement("script");' +
                                                                's.type = "text/javascript";s.async = true;' +
                                                                's.src = "\/\/localhost'+data+'"; var ss = document.getElementsByTagName("script")[0];' +
                                                                'ss.parentNode.insertBefore(s, ss);})();}\n' +
                                                                '<\/script>');
                                                            });
                                                        }).hide();
                                                    });
                                                    function options(item){
                                                        var id = $('#'+item.id+'').parent().parent().data('id');
                                                        var value = $('#'+item.id+'').parent().parent().data('value');
                                                        var desc = $('#'+item.id+'').parent().parent().data('desc');
                                                        var controlGroupStart = '<div class="control-group" id="'+id+'" data-value="'+desc+'">';
                                                        var controlLabel = '<label class="control-label" style="width: 100%;text-align: left;margin-left: 180px;">'+value+'</label>';
                                                        var controls = '<div class="controls"><input type="text" class="span6 m-wrap" name="web_client" placeholder="Пример: id(#block) && class(.block)" /></div>'
                                                        var controlGroupEnd = '</div>';
                                                        if(item.value == 'yes'){
                                                            if($("#"+id+"").length == 0){
                                                                $('#tab3').append(controlGroupStart+controlLabel+controls+controlGroupEnd);
                                                            }
                                                        }else{
                                                            if($("#"+id+"").length == 1){
                                                                $('#'+id+'').remove();
                                                            }
                                                        }
                                                    }
                                                </script>
                                                <div class="control-group">
                                                    <label class="control-label"  style="text-align: left;width: 100%;">Наличие фотографий у всех карточек товаров в каталоге</label>
                                                    <div class="controls" data-id="foto" data-desc="Наличие фотографий у всех карточек товаров в каталоге" data-value="Укажите название 'class/id' в котором находится фотографии карточек товаров">
                                                        <label class="radio"><input type="radio" name="optionsRadiosFoto" onclick="options(this)" id="optionsRadiosFoto" value="yes"/>Проверять</label></br>
                                                        <label class="radio"><input type="radio" name="optionsRadiosFoto" onclick="options(this)" id="optionsRadiosFoto"
                                                                                    value="no"/>Не проверять</label>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label"  style="text-align: left;width: 100%;">Наличие цен на всех страницах карточек товара</label>
                                                    <div class="controls" data-id="price" data-desc="Наличие цен на всех страницах карточек товара" data-value="Укажите название 'class/id' в котором находится цена карточек товаров">
                                                        <label class="radio"><input type="radio" name="optionsRadiosPrice" onclick="options(this)" id="optionsRadiosPrice"
                                                                                    value="yes"  />Проверять</label></br>
                                                        <label class="radio"><input type="radio" name="optionsRadiosPrice" onclick="options(this)" id="optionsRadiosPrice"
                                                                                    value="no"/>Не проверять</label>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label"  style="text-align: left;width: 100%;">Наличие фотографий товара на всех страницах карточек товара</label>
                                                    <div class="controls" data-id="fotoProducts" data-desc="Наличие фотографий товара на всех страницах карточек товара" data-value="Укажите название 'class/id' в котором находится фотографии на страницах каталога">
                                                        <label class="radio"><input type="radio" name="optionsRadiosFotoProducts" onclick="options(this)" id="optionsRadiosFotoProducts"
                                                                                    value="yes"  />Проверять</label></br>
                                                        <label class="radio"><input type="radio" name="optionsRadiosFotoProducts" onclick="options(this)" id="optionsRadiosFotoProducts"
                                                                                    value="no"/>Не проверять</label>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label"  style="text-align: left;width: 100%;">Наличие фотографий у всех превью товаров в каталоге</label>
                                                    <div class="controls" data-id="fotoProductsPrevie" data-desc="Наличие фотографий у всех превью товаров в каталоге" data-value="Укажите название 'class/id' в котором находится фотографии в превью каталога">
                                                        <label class="radio"><input type="radio" name="optionsRadiosFotoProductsPrevie" onclick="options(this)" id="optionsRadiosFotoProductsPrevie"
                                                                                    value="yes"  />Проверять</label></br>
                                                        <label class="radio"><input type="radio" name="optionsRadiosFotoProductsPrevie" onclick="options(this)" id="optionsRadiosFotoProductsPrevie"
                                                                                    value="no"/>Не проверять</label>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label"  style="text-align: left;width: 100%;">Возможность войти в админку сайта</label>
                                                    <div class="controls" data-id="admin" data-desc="Возможность войти в админку сайта" data-value="Укажите url по которому находится административная-панель управления">
                                                        <label class="radio"><input type="radio" name="optionsRadiosAuthAdmin" onclick="options(this)" id="optionsRadiosAuthAdmin"
                                                                                    value="yes"  />Да</label></br>
                                                        <label class="radio"><input type="radio" name="optionsRadiosAuthAdmin" onclick="options(this)" id="optionsRadiosAuthAdmin"
                                                                                    value="no"/>Нет</label>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"  style="text-align: left;width: 100%;">Корректность и скорость добавления товара в корзину</label>
                                                    <div class="controls" data-id="speedCart" data-desc="Корректность и скорость добавления товара в корзину" data-value="Пока в разработке">
                                                        <label class="radio"><input type="radio" name="optionsRadiosAjaxProducts" onclick="options(this)" id="optionsRadiosAjaxProducts"
                                                                                    value="yes"  />Проверять</label></br>
                                                        <label class="radio"><input type="radio" name="optionsRadiosAjaxProducts" onclick="options(this)" id="optionsRadiosAjaxProducts"
                                                                                    value="no"/>Не проверять</label>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane" id="tab3">
                                                <h3 class="block">Настройка опций</h3>
                                            </div>
                                            <div class="tab-pane" id="tab4">
                                                <h3 class="block">Готовый скрипт</h3>
                                                <pre id="tan4" style="opacity: 0;"></pre>
                                                <div class="control-group">
                                                    <label class="control-label" >Имя клиента:</label>
                                                    <div class="controls">
                                                        <span class="text" id="name_client"></span>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Сайт клиента:</label>
                                                    <div class="controls">
                                                        <span class="text" id="web_client"></span>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Список опций:</label>
                                                    <div class="controls" id="options">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"></label>
                                                    <div class="controls">
                                                        <label class="checkbox">
                                                            <input type="checkbox" value="all_good" /> Все верно?
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions clearfix">
                                            <a href="javascript:;" class="btn button-previous">
                                                <i class="m-icon-swapleft"></i> Назад
                                            </a>
                                            <a href="javascript:;" class="btn blue button-next">
                                                Дальше <i class="m-icon-swapright m-icon-white"></i>
                                            </a>
                                            <a href="javascript:;" class="btn green button-submit" id="isisubmit" onclick="" style="width: 300px;">
                                                Скачать скрипт и добавить нового клиента <i class="m-icon-swapright m-icon-white"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT-->
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
    </div>
    <!-- END PAGE -->
    </div>
    <!-- END CONTAINER -->


@endsection
