<?php namespace Laravel\Http\Controllers;
use DB;

class MonitoringController extends Controller {

    private $array = [];
    /**
     * Метод для cron
     * Он отправляет массив индефикаторов другому методу который и делает парсинг сайта
     */
     public function index(){
         $this->array = $this->domain(DB::table('clients')->where('http_code', '200')->get());
         if($this->array === 1)
             return '1';
         else
             return '0';
     }         

}
