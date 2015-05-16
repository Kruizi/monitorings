<?php namespace Laravel\Http\Controllers;
use Illuminate\Contracts\Auth\Authenticatable;
use Route;
use Laravel\People;
use DB;

class IndexController extends Controller {

    public function __construct()
    {
        $this->title = Route::currentRouteName();
        $this->ind = People::countBDnot();
        $this->not = People::notification();
        $this->middleware('auth');
    }

    /**
     * @param Authenticatable $user
     * @return \Illuminate\View\View
     */
    public function index(Authenticatable $user )
    {
        /** @var  $name
         * берем имя пользователя */
        if (!empty($user->name)) {
            $name = $user->name;
        }
        /** @var  $url
         * берем название страницы */
        if (!empty($this->title)) {
            $title = $this->title;
        }
        /** @var  $ind
         * количество уведомлений */
        if (isset($this->ind)) {
            $ind = $this->ind;
        }
        /** @var  $not
         * Выводим уведомления */
        if (isset($this->not)) {
            $notification = $this->not;
        }
        /** @var $client
         * Клиенты(сайты) которые есть в БД*/
        $client = DB::table('clients')->get();
        return view('index', compact('name','client', 'ind', 'notification', 'title'));
    }
     
     
     /**
      * Метод для cron №2
      * Метод проверяет главные страницы сайтов на доступность(пока не проверяет)
      */
      
      public function runCheckedWeb(){
        return null;
      }

    public function testing(){
        if(count(array_count_values($this->domain(DB::table('clients')->where('http_code', '200')->get()))) === 1)
            return '1';
        else
            return '0';
    }
}
