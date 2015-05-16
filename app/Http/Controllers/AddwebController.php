<?php namespace Laravel\Http\Controllers;
use Illuminate\Contracts\Auth\Authenticatable;
use Route;
use Laravel\People;
use DB;

class AddwebController extends Controller {

    public function __construct()
    {
        $this->title = Route::currentRouteName();
        $this->ind = People::countBDnot();
        $this->not = People::notification();
        $this->middleware('auth');
    }

    public function index(Authenticatable $user ){
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
        $host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        return view('add-web', compact('name','ind', 'notification', 'title'));
    }
}
