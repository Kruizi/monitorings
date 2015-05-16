<?php namespace Laravel\Http\Controllers;
use DB;

class AjaxController extends Controller {

     /**
      * Метод для график на ajax все цифры рандомные
      */
     public function index(){
        $in = [['label' => '2015-04-09', 'value' => '50z'],['label' => '2015-04-07', 'value' => '4']];
        $info_clients = DB::table('parcing_192485')->get();
        // создаем новый массив с данными
        $i = 0;
        foreach ($info_clients as $key => $value) {
            $data[$key]['label'] = '2015-05-'.mt_rand(1,31).'';
            $data[$key]['value'] = 99.9;
        }
        $js = json_encode($data);
        return $js;           
     }  
}
