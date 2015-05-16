<?php namespace Illuminate\Routing;

use Closure;
use BadMethodCallException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Laravel\Http\Requests;
use Illuminate\Database\Schema\Blueprint;
use Laravel\People;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

abstract class Controller {

	/**
	 * The middleware registered on the controller.
	 *
	 * @var array
	 */
	protected $middleware = [];

	/**
	 * The "before" filters registered on the controller.
	 *
	 * @var array
	 */
	protected $beforeFilters = array();

	/**
	 * The "after" filters registered on the controller.
	 *
	 * @var array
	 */
	protected $afterFilters = array();

	/**
	 * The router instance.
	 *
	 * @var \Illuminate\Routing\Router
	 */
	protected static $router;

	/**
	 * Register middleware on the controller.
	 *
	 * @param  string  $middleware
	 * @param  array   $options
	 * @return void
	 */
	public function middleware($middleware, array $options = array())
	{
		$this->middleware[$middleware] = $options;
	}

	/**
	 * Register a "before" filter on the controller.
	 *
	 * @param  \Closure|string  $filter
	 * @param  array  $options
	 * @return void
	 */
	public function beforeFilter($filter, array $options = array())
	{
		$this->beforeFilters[] = $this->parseFilter($filter, $options);
	}

	/**
	 * Register an "after" filter on the controller.
	 *
	 * @param  \Closure|string  $filter
	 * @param  array  $options
	 * @return void
	 */
	public function afterFilter($filter, array $options = array())
	{
		$this->afterFilters[] = $this->parseFilter($filter, $options);
	}

	/**
	 * Parse the given filter and options.
	 *
	 * @param  \Closure|string  $filter
	 * @param  array  $options
	 * @return array
	 */
	protected function parseFilter($filter, array $options)
	{
		$parameters = array();

		$original = $filter;

		if ($filter instanceof Closure)
		{
			$filter = $this->registerClosureFilter($filter);
		}
		elseif ($this->isInstanceFilter($filter))
		{
			$filter = $this->registerInstanceFilter($filter);
		}
		else
		{
			list($filter, $parameters) = Route::parseFilter($filter);
		}

		return compact('original', 'filter', 'parameters', 'options');
	}

	/**
	 * Register an anonymous controller filter Closure.
	 *
	 * @param  \Closure  $filter
	 * @return string
	 */
	protected function registerClosureFilter(Closure $filter)
	{
		$this->getRouter()->filter($name = spl_object_hash($filter), $filter);

		return $name;
	}

	/**
	 * Register a controller instance method as a filter.
	 *
	 * @param  string  $filter
	 * @return string
	 */
	protected function registerInstanceFilter($filter)
	{
		$this->getRouter()->filter($filter, array($this, substr($filter, 1)));

		return $filter;
	}

	/**
	 * Determine if a filter is a local method on the controller.
	 *
	 * @param  mixed  $filter
	 * @return bool
	 *
	 * @throws \InvalidArgumentException
	 */
	protected function isInstanceFilter($filter)
	{
		if (is_string($filter) && starts_with($filter, '@'))
		{
			if (method_exists($this, substr($filter, 1))) return true;

			throw new InvalidArgumentException("Filter method [$filter] does not exist.");
		}

		return false;
	}

	/**
	 * Remove the given before filter.
	 *
	 * @param  string  $filter
	 * @return void
	 */
	public function forgetBeforeFilter($filter)
	{
		$this->beforeFilters = $this->removeFilter($filter, $this->getBeforeFilters());
	}

	/**
	 * Remove the given after filter.
	 *
	 * @param  string  $filter
	 * @return void
	 */
	public function forgetAfterFilter($filter)
	{
		$this->afterFilters = $this->removeFilter($filter, $this->getAfterFilters());
	}

	/**
	 * Remove the given controller filter from the provided filter array.
	 *
	 * @param  string  $removing
	 * @param  array   $current
	 * @return array
	 */
	protected function removeFilter($removing, $current)
	{
		return array_filter($current, function($filter) use ($removing)
		{
			return $filter['original'] != $removing;
		});
	}

	/**
	 * Get the middleware assigned to the controller.
	 *
	 * @return array
	 */
	public function getMiddleware()
	{
		return $this->middleware;
	}

	/**
	 * Get the registered "before" filters.
	 *
	 * @return array
	 */
	public function getBeforeFilters()
	{
		return $this->beforeFilters;
	}

	/**
	 * Get the registered "after" filters.
	 *
	 * @return array
	 */
	public function getAfterFilters()
	{
		return $this->afterFilters;
	}

	/**
	 * Get the router instance.
	 *
	 * @return \Illuminate\Routing\Router
	 */
	public static function getRouter()
	{
		return static::$router;
	}

	/**
	 * Set the router instance.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public static function setRouter(Router $router)
	{
		static::$router = $router;
	}

	/**
	 * Execute an action on the controller.
	 *
	 * @param  string  $method
	 * @param  array   $parameters
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function callAction($method, $parameters)
	{
		return call_user_func_array(array($this, $method), $parameters);
	}

	/**
	 * Handle calls to missing methods on the controller.
	 *
	 * @param  array   $parameters
	 * @return mixed
	 *
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 */
	public function missingMethod($parameters = array())
	{
		throw new NotFoundHttpException("Controller method not found.");
	}

	/**
	 * Handle calls to missing methods on the controller.
	 *
	 * @param  string  $method
	 * @param  array   $parameters
	 * @return mixed
	 *
	 * @throws \BadMethodCallException
	 */
	public function __call($method, $parameters)
	{
		throw new BadMethodCallException("Method [$method] does not exist.");
	}


    /** ------------------------------------------------ My Settings ----------------------------------------------- */

    protected $title;
    protected $ind;
    protected $imagesCheckedPreg = [];
    protected $imagesChecked = [];
    protected $not = [];
    protected $images = [];
    protected $get_client = [];
    protected $dd = [];
    /**
     * @var array
     * Переменная с массивом в котором будет
     * Отчищенная и обрезанная ссылка сайта
     */
    protected $scrUrl = [];
    /**
     * @var array
     * Переменная с массивом в котором будут обрезаться ссылки от название сайта
     */
    protected $strReplaceUrl = [];

    /**
     * @var array
     * Массив с пропарсенными ссылками
     */
    protected $arrayCheckedUrl = [];


    /**
     * @var array
     * Массив доплнительных ссылок
     */
    protected $arrayCubUrl = [];

    /**
     * @return array Возвращаем пропаресерные ссылки
     * @internal param $urlWeb
     */
    public function domain($array_clients){
        for($i = 0; $i < count($array_clients);){
            $return = $this->getUrl($array_clients[$i]->indeficators ,substr($array_clients[$i]->web_clients, 0, -1));
            if(count(array_count_values($return)) === 1){
                $i++;
            }else{
                $return[] = count(array_count_values($return));
            }
        }
        /** @var TYPE_NAME $return */
        return $return;
    }
    /**
     * @param $indeficator
     * @param $urlWeb
     * @return array|bool
     * Ищщем ссылки
     */
    protected function getUrl($indeficator,$urlWeb){
        /** @var  $isDomain array в котором придут пропарсенные ссылки, удалены пустые и одинаковые ссылки */
        $isDomain = array_merge(array_unique(array_diff($this->isDomain($urlWeb), array(''))));
        if (!empty($isDomain)) {
            for ($i = 0; $i < count($isDomain); $i++) {
                if (People::countBD($indeficator,$isDomain[$i]) <= 0) {
                        People::whereInsert($indeficator,$urlWeb,$isDomain[$i],date("Y-m-d H:i:s"),get_headers($urlWeb.$isDomain[$i])[0]);
                }
            }
            if(People::countBD($indeficator,$isDomain[0]) != 0){
                return $this->searchCubUrl($indeficator,$urlWeb);
            }else
            {
                return false;
            }
        }
    }

    /**
     * @param $indeficator
     * @param $urlWeb
     * Ищем новые ссылки и отправляем их на сохранение в базу данных
     * @return array
     */
    protected function searchCubUrl($indeficator,$urlWeb){
        $cubUrl = People::allData($indeficator);
        $cubUrlArray[] = '';
        for($i = 0; $i < count($cubUrl); $i++){
            $nameDomen[] = $cubUrl[$i]->desc.$cubUrl[$i]->original_url;
            if(!empty($nameDomen)){
                $cubUrlArray = array_merge(array_unique(array_diff($this->isDomain($nameDomen[$i]), array(''))));
            }
        }
        return $this->addCubUrl($cubUrlArray,$urlWeb,$indeficator);
    }

    /**
     * @param $cubUrlArray
     * @param $urlWeb
     * Добавляем новые ссылки в базу данных
     * @param $indeficator
     * @return array
     */
    protected function addCubUrl($cubUrlArray,$urlWeb,$indeficator){
        $cubUrlArrayNew[] = '';
        $date = date("Y-m-d H:i:s");
        for($i = 0; $i < count($cubUrlArray); $i++) {
            if (!empty($cubUrlArray)) {
                if (People::countBD($indeficator, $cubUrlArray[$i]) <= 0) {
                        People::whereInsert($indeficator, $urlWeb, $cubUrlArray[$i], $date, get_headers($urlWeb.$cubUrlArray[$i])[0]);
                        if(preg_match("/(OK|200)/is", get_headers($urlWeb.$cubUrlArray[$i])[0] ) == true){
                            $soobchenie = "Собственно это содержимое письма";
                            $komu = '<почта_адресата@example.com>';
                            $tema_pisma = "Тема отправленного сообщения";

                            $zagolovki = "MIME-Version: 1.0\r\n";
                            $zagolovki .= "Content-type: text/html; charset=UTF-8\r\n";
                            $zagolovki .= "From: <почта_отправителя@example.com>\r\n";
                            mail($komu, $tema_pisma, $soobchenie, $zagolovki);
                        }
                    $return[] = 1;
                } else {
                    $return[] = 0;
                }
            }
        }
        /** @var int $return */
        return $return;
    }
    /**
     * @param $url
     * @return array
     * Парсим ссылки сайта
     */
    protected function isDomain($url)
    {
        $ch = curl_init();
        $arrayCheckedUrl[] = '';
        curl_setopt ($ch, CURLOPT_URL,$url);// ссылка
        curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)"); //УХАХАХУАХАХУАХУХАХУАХУХА
        curl_setopt ($ch, CURLOPT_TIMEOUT, 15 ); // таймаут
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0);curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec ($ch); curl_close($ch);
        /** Джедаевская регулярка не моя, взята с буржуйского форума */
        preg_match_all('/<(?:[aA][\s]+[hH][rR][eE][fF]|[iI][mM][gG][\s]+.*[\s]+[sS][rR][cC])[\s]*=[\s]*[\'"]([^\s">]+)[\'"]/',$result,$links);
        $arrayChek = $this->checkUrl($links[1]);
        /** @var TYPE_NAME $arrayChek */
        for($i = 0; $i < count($arrayChek); $i++){
            if(preg_match("/(css|js|advertising.yandex.ru|metrika.yandex.ru|gorod\.it|captcha_sid|liveinternet|auth|jpg|png|jpeg|gif|ico)/is", $arrayChek[$i] ) == false)
                $arrayCheckedUrl[] = $arrayChek[$i];
        }
        return $arrayCheckedUrl;
    }
    /**
     * @param $url
     * @return bool
     * Отчистим от всякого мусора и уберем название сайта
     */
    protected function checkUrl($url){
        $search = [
                 "'|#(.*)|Uis'",
                 "/(\w+)\:(\w+).*/",
                 "/(http|https)\:\/\/(.*?)\.(ru|su|com|org|reg|рф|kz)/"];
        foreach($url as $arr)
        {
                 if (preg_replace($search, '', $arr) == true)
                    $this->scrUrl[] = $arr;
        }        
        return preg_replace($search, '', $this->scrUrl);
    }

    /**
     * Берем скорость загрузки страницы
     * Размер загружаемого сайта
     * Код ошибки и как ее исправить, сделанно жестковато но работать должно на "ура"
     * @param $url
     * @return array
     */
    protected function staticWeb($url){
        if(filter_var($url, FILTER_VALIDATE_URL)) {
                $arrayReplyHead[] = $this->checkedError($url);
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1 );
                curl_exec($ch);
                $info = curl_getinfo($ch);
                if(!curl_errno($ch))
                {
                    $stat = 0;
                    People::addAnswerHttpHead($stat,$arrayReplyHead,$url);
                    return ['accessibility' => $arrayReplyHead[0][1],
                            'coonect_time' => $info['connect_time'],
                            'speed_download' => $info['total_time'],
                            'size_page' => $this->format_size($info['size_download']),
                            'code_error' => $arrayReplyHead[0][0],
                            'desc_error' => $arrayReplyHead[0][2]];
                }else
                {
                    $stat = 2;
                    People::addAnswerHttpHead($stat,$arrayReplyHead);
                    return ['accessibility' => $arrayReplyHead[1],
                            'coonect_time' => $info['connect_time'],
                            'speed_download' => $info['total_time'],
                            'size_page' => $this->format_size($info['size_download']),
                            'code_error' => $arrayReplyHead[0],
                            'desc_error' => $arrayReplyHead[2]];
                    
                }                   
            }else
            {
                DB::update('update clients set status = 2 where web_clients = ?', [$url]);
                    return ['accessibility' => $http_code,
                            'coonect_time' => $info['connect_time'],
                            'speed_download' => $info['total_time'],
                            'size_page' => $info['size_download'],
                            'code_error' => $codeError];
            }
    }

    /**
     * Изменяем размер который к нам придет переводим его в понятный размер
     * @param $size
     * @param int $type
     * @return string
     */
    protected function format_size($size, $type=0) {
        if ($type == 0) {
            $iec = array('байт', 'Килобайт', 'Мегабайт', 'Гигабайт', 'Терабайт', 'Петабайт', 'Эксабайт');
        }
        $i = 0;
        while (($size/1024)>1) {
            $size = $size/1024;
            $i++;
        }
        /** @var int $iec */
        $echo = round($size).' '.$iec[$i];
        return $echo;
    }
    /**
     * Делаем изображение сайта
     * Как сайт выглядит и установим правило чтобы он обновлял картинку только каждые 5 часов при заходе на сайт
     */
    protected function imgWeb($imgWebArray){
        /** Текущию дату и дату которая записана в БД мы представляем даты на английском языке в метку времени Unix
         * И проверяем что прошло 5 часов */
        if(strtotime(date("Y-m-d H:i:s")) - strtotime($imgWebArray->imgDate) > 18000){
            /** Куда сохраняем картинку */
            $fp = fopen('sceenshots/'.$imgWebArray->webNameClients.'.png', 'w');
            /** Бере саму картинку использую API */
            fwrite($fp, file_get_contents('http://mini.s-shot.ru/1280x1600/png/?'.$imgWebArray->webClients));
            /** Закрываем файл */
            fclose($fp);
            /** Записываем текущию дату в БД */
            DB::update('update clients set img_date = "'.date("Y-m-d H:i:s").'" where indeficators = ?', [$imgWebArray->indeficators]);
        }
    }
    
    
    /**
     * 
     * При заходе на /static-*******
     * Появляется окно которое показывает статистику сайта
     * Ошибки если они есть, код ошибки и что нужно делать
     * МЕТОД ПОКА В РАЗРАБОТКЕ
     */
    protected function checkedError($url){
        if(get_headers($url))
                {
                    //Запишим статус в переменную
                    $codeError = get_headers($url)[0]; 
                        //$error_400 это массив ошибок "400", посмотреть файл можно по адресу resources/lang/en/error.php
                        //Lang::get('название файла.название массива в котором описание ошибки')
                        $error_500 = Lang::get('error.error_500');
                        $error_400 = Lang::get('error.error_400');
                        $error_200 = Lang::get('error.error_200'); 
                        /**
                         * Собственно ищем какой к нам пришел статус в переменную $codeError 
                         * и пропишем в переменну $error_side на какой стороне ошибка 
                         */                                     
                        if(preg_match("/($error_500)/is", $codeError)){
                            preg_match("/($error_500)/is", $codeError,$matches);
                            $errorSide = Lang::get('error.server');
                        }
                        if(preg_match("/($error_400)/is", $codeError)){
                            preg_match("/($error_400)/is", $codeError,$matches);
                            $errorSide = Lang::get('error.client');
                        }
                        if(preg_match("/($error_200)/is", $codeError)){
                            preg_match("/($error_200)/is", $codeError,$matches);
                            $errorSide = Lang::get('error.clientOK');
                        }
                        // Описание самой ошибки                                                                          
                        $descCodeError = Lang::get('error.'.$matches[0].'');                           
                }else{ 
                        // :С выводи неизвестную ошибку
                        $descCodeError = Lang::get('error.null');
                }
        return [$descCodeError,$matches[0],$errorSide];
    }
    
    public function imagesChecked($url,$id,$get_client){
        if(preg_match_all('/[A-ZА-Яa-zа-я.-_*]+\.(png|jpg|jpeg)/is',implode("\n", $this->imagesCheckedPreg($url)),$links) !== false){
                $lin = $links[0];
        }
        /** @var int $lin */
        for($i = 0; $i < count($lin); $i++){
            $this->imagesChecked[] = ['web' => mb_substr($get_client, 0, -1).People::imagesChecked($id,$lin[$i]),
                                      'http_code' => $this->checkedError(mb_substr($get_client, 0, -1).People::imagesChecked($id,$lin[$i]))[1]];
        }
        return $this->imagesChecked;
    }
    /**
     * Проверяем какие изображение есть на сайте
     */
     protected function imagesCheckedPreg($url){
        for($i = 0; $i < count($url); $i++){
            $this->imagesCheckedPreg[] = $url[$i]->original_url;
        }
        return $this->imagesCheckedPreg;    
     }

    /**
     * @return string
     */
    protected function fotoProductsScript(){
        /** Берем адрес откуда приходят запросы и сравниваем что отдает скрипт (Ведь адрес нашего скрипта зашифрован)*/
        $web = parse_url($_SERVER['HTTP_REFERER']);
        /** Простенькая проверка на запрос от ajax*/
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            /** Проверяем что пришло число*/
            if(is_numeric($this->decripts(Input::get('dd')))) {
                /** Сравниваем откуда пришел запрос*/
                if ($this->decripts(Input::get('las')) === $web['scheme'].'://'.$web['host'].'/') {
                    /** Проверяем существование таблицы */
                    if (Schema::hasTable('images_'.$this->decripts(Input::get('dd'))))
                    {
                        /** Делаем цикл добавление ссылок в БД */
                        for($i = 0;$i < count(Input::get('choices')); $i++){
                            /**Эту проверку мы делаем на доступность картинке и отправляем в уведомление*/
                            if(get_headers(Input::get('choices')[$i])[0] === 'HTTP/1.1 200 OKS'){ return true;}
                            /**
                             * Далее мы делаем проверку существуют ли в таблице такая запись
                             * если да то добавляем, если нет то обновим существующие
                             */
                            if(DB::table('images_'.$this->decripts(Input::get('dd')))->where('images', '=', Input::get('choices')[$i])->count() == 0){
                                DB::table('images_'.$this->decripts(Input::get('dd')))->insertGetId(
                                    array('images' => Input::get('choices')[$i], 'date_add_images' => date("Y-m-d H:i:s"), 'title' => Input::get('title'), 'http_code' => get_headers(Input::get('choices')[$i])[0])
                                );
                            }else{
                                DB::table('images_'.$this->decripts(Input::get('dd')))
                                    ->where('images', Input::get('choices')[$i])
                                    ->update(array('images' => Input::get('choices')[$i], 'date_add_images' => date("Y-m-d H:i:s"), 'title' => Input::get('title'), 'http_code' => get_headers(Input::get('choices')[$i])[0] ));
                            }
                        }
                        return 'ye';
                    }else{
                        /** Схема тажа, только 1 что мы делаем это создаем таблицу */
                        Schema::create('images_'.$this->decripts(Input::get('dd')), function(Blueprint $table){$table->increments('id');$table->string('images', 255);$table->string('title', 100);$table->string('http_code', 155);$table->dateTime('date_add_images');});
                        for($i = 0;$i < count(Input::get('choices')); $i++){
                            /**Эту проверку мы делаем на доступность картинке и отправляем в уведомление*/
                            if(get_headers(Input::get('choices')[$i])[0] === 'HTTP/1.1 200 OKS'){ return true;}
                            if(DB::table('images_'.$this->decripts(Input::get('dd')))->where('images', '=', ''.Input::get('choices')[$i].'')->count() == 0){
                                DB::table('images_'.$this->decripts(Input::get('dd')))->insertGetId(
                                    array('images' => Input::get('choices')[$i], 'date_add_images' => date("Y-m-d H:i:s"), 'title' => Input::get('title'), 'http_code' => get_headers(Input::get('choices')[$i])[0])
                                );
                            }else{
                                DB::table('images_'.$this->decripts(Input::get('dd')))
                                    ->where('images', Input::get('choices')[$i])
                                    ->update(array('images' => Input::get('choices')[$i], 'date_add_images' => date("Y-m-d H:i:s"), 'title' => Input::get('title'), 'http_code' => get_headers(Input::get('choices')[$i])[0]));
                            }
                        }
                        return 'ye2';
                    }
                }
                return 'Далеко ушел, попробуй еще раз!';
            }
            return 'ID error';
        }
        return '.!.';
     }

}
