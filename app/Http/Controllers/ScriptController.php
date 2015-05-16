<?php namespace Laravel\Http\Controllers;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Input;

class ScriptController extends Controller {

    /**
     * @return string
     * Главный метод который генерирует рандомное число, возвращает скрипт, и сохраняет файл с названием клиента и рандомныем числом.
     * Возвращает он строку в которой передается путь к скрипту с названием файла
     */
    public function index(){
        $rand = mt_rand(1000000,5000000);
        $scr = $this->downloadScript(array_combine(Input::get('valueAr'),Input::get('inputValueAr')));
        $fp = fopen("js/file_script_client/".$this->transliterate(Input::get('name_client'))."_".$rand.".js", "w");
        fwrite($fp, '$(document).ready(function(){'.implode("", $scr).'});$.get(\'http://localhost/fotoProductsScript/\', {dd: "'.$this->cripts(Input::get('id')).'",las: "'.$this->cripts(Input::get('web_client')).'",\'choices[]\': fotoArray, title:title});');
        fclose($fp);
        return "/public/js/file_script_client/".$this->transliterate(Input::get('name_client'))."_".$rand.".js";
    }

    /**
     * @param $array
     * @return array
     * Этот метод ловит значение по которому будет выдаваться текст скрипта
     */
    public function downloadScript($array){
        foreach($array as $key=>$value){
            if($key === 'foto')
                $data[] = $this->fotoScript($value);
            elseif($key === 'price')
                $data[] = $this->priceScript($value,Input::get('id'),Input::get('web_client'));
            elseif($key === 'fotoProducts')
                $data[] = $this->fotoProducts($value,Input::get('id'),Input::get('web_client'));
            elseif($key === 'fotoProductsPrevie')
                $data[] = $this->fotoProductsPrevie($value,Input::get('id'),Input::get('web_client'));

        }
        /** @var array $data */
        return $data;
    }

    /**
     * @param $val
     * @return string
     * метод возвращает готовый скрипт для поиск изображений
     */
    protected function fotoScript($val){
        return 'window.fotoArray = [];window.title = $("title").text();$("body").find("'.$val.'").each(function(){fotoArray.push(this.currentSrc);});';
    }
    public function urlFoto()
    {
        return $this->fotoProductsScript();
    }
}
