<?php
namespace Goods;

class OrderModel
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getOrderId()
    {
        return $this->id;
    }
}
