<?php
namespace App\Models\Domains\Repositories;

use App\Models\Entity\IEntity;

/**
 * Interface IRepository
 * The Repository Base Interface
 *
 * @package Domains\Repositories
 */
interface IRepository
{
    public function load($id);

    public function save(IEntity $entity);

    public function destroy(IEntity $entity);
}

