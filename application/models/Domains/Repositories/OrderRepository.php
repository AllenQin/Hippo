<?php
namespace Domains\Repositories;

use App\Models\Domains\Repositories\IRepository;
use App\Models\Entity\IEntity;
use Illuminate\Database\Eloquent\Model;

class OrderRepository implements IRepository
{
    private $orderModel;

    public function __construct(Model $orderModel)
    {
        $this->orderModel = $orderModel;
    }

    public function load($id)
    {
        // TODO: Implement save() method.
    }

    public function save(IEntity $entity)
    {
        // TODO: Implement save() method.
    }

    public function destroy(IEntity $entity)
    {
        // TODO: Implement destroy() method.
    }
}
