<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

    Route::get('/', [
        'as' => 'Главная', 'uses' => 'IndexController@index'
    ]);
    Route::get('/static-{id}', [
        'as' => 'Статистика', 'uses' => 'StaticController@index'
    ]);
    Route::get('/monitoring/run/', [
        'as' => 'Мониторинг', 'uses' => 'MonitoringController@index'
    ]);   
    Route::get('searchpeeps', array('before' => 'csrf', 'uses' => 'AjaxController@index'));

    Route::get('/add-web/', [
        'as' => 'Главная', 'uses' => 'AddwebController@index'
    ]);
    Route::get('/testing-page/', [
        'as' => 'Главная', 'uses' => 'IndexController@testing'
    ]);


    // ajax запрос идут дальше
    Route::post('/java-script/', [
        'as' => 'Скрипт', 'uses' => 'ScriptController@index'
    ]);
    Route::get('/fotoProductsScript/',[
        'as' => 'Скрипт', 'uses' => 'ScriptController@urlFoto'
    ]);
    Route::get('/priceProductsScript/',[
        'as' => 'Скрипт', 'uses' => 'ScriptController@priceProductsScript'
    ]);
    Route::get('/fotoProductsCarScript/',[
        'as' => 'Скрипт', 'uses' => 'ScriptController@fotoProductsCarScript'
    ]);
    Route::get('/fotoProductsPrevieCarScript/',[
        'as' => 'Скрипт', 'uses' => 'ScriptController@fotoProductsCarScript'
    ]);






    Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]);
