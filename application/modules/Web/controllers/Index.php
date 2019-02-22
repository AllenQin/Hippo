<?php

use App\Library\Core\MVC\Controller;
use App\Models\Event\OrderPlacedEvent;
use Goods\OrderModel;
use User\UserModel;

class IndexController extends Controller
{
    public function indexAction()
    {
        $rule = [
            'username' => 'required|string|min:2|max:20',
        ];
        $data = [
            'username' => 'allenqin',
            'age' => 20,
        ];
        $this->assert->validate($rule, $data, [], ['username' => '姓名']);

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
