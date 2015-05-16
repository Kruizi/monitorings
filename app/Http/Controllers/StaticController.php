<?php namespace Laravel\Http\Controllers;
use Illuminate\Contracts\Auth\Authenticatable;
use Route;
use Laravel\People;
use DB;

class StaticController extends Controller {

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
    public function index(Authenticatable $user,$id)
    {
        $this->get_client = $this->getClient($id);
        $this->dd = $this->staticWeb($this->get_client->web_clients);
        /** @var  $name
         * берем имя пользователя */
        if (!empty($user->name)) {$name = $user->name;}
        /** @var  $url
         * берем название страницы */
        if (!empty($this->title)) {$title = $this->title;}
        /** @var  $ind
         * количество уведомлений */
        if (isset($this->ind)) {$ind = $this->ind;}
        /** @var  $not
         * Выводим уведомления */
        if (isset($this->not)) {$notification = $this->not;}
        /** @var $get_client
         * Данные о клиенте */
        if (!empty($this->get_client)) {$get_client = $this->get_client;}
        /** @var $get_client
         * Получаем статистику клиента */
        if (!empty($this->dd)) {$dd = $this->dd;}
        $img = $this->imagesChecked(People::images($id),$id,$get_client->web_clients);
        return view('edit', compact('name','dd', 'ind', 'notification', 'title', 'get_client', 'img'));
    }
    
    /** @param $id
     * Клиенты(сайты) которые есть в БД*/
    public function getClient($id){
        return DB::table('clients')->where('indeficators', '=', $id)->first();
    }
}
