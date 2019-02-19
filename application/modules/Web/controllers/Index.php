<?php

use App\Library\Core\Database\DatabaseInterface;
use App\Library\Core\MVC\Controller;
use App\Library\Core\Queue\HQueue;
use App\Models\Event\OrderPlacedEvent;
use App\Models\Jobs\OrderJob;
use Goods\OrderModel;
use Illuminate\Support\Collection;
use User\UserModel;

class IndexController extends Controller
{
    public function indexAction()
    {
        $users = UserModel::all();
        $showUsers = $users->transform(function($user){
            return ['name' => $user->user_name, 'age' => $user->age + 1, 'id' => $user->id];
        });

        foreach ($showUsers->toArray() as $item) {
            $order = new OrderModel($item['id']);
            $eventDispatcher = $this->di->get('eventDispatcher');
            $eventDispatcher->dispatch(OrderPlacedEvent::NAME, new OrderPlacedEvent($order));
        }

        $this->display('index', ['content' => 'Hippo!']);
    }
}
