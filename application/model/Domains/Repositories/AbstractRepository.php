<?php
namespace App\Model\Domains\Repositories;

use App\Library\Core\MVC\EloquentModel;

/**
 * Class AbstractRepository
 * @package App\Model\Domains\Repositories
 */
abstract class AbstractRepository
{
    /**
     * @var EloquentModel
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelName;

    /**
     * AbstractRepository constructor.
     * @param EloquentModel $model
     */
    public function __construct(EloquentModel $model)
    {
        $this->model = $model;
        $this->modelName  = get_class($this->model);
    }

    /**
     * Find a single entity object by pk
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * Find a single entity object by condition
     *
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = ['*'])
    {
        return $this->model
            ->where($attribute, '=', $value)
            ->first($columns);
    }

    /**
     * Get quantity by query condition
     *
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function findCountBy($attribute, $value)
    {
        return $this->model
            ->where($attribute, '=', $value)
            ->count();
    }

    /**
     * Query a single entity, if it does not exists, create a new one and return
     *
     * @param array $data
     * @param array $values
     * @return mixed
     */
    public function firstOrCreate(array $data, $values = [])
    {
        return $this->model->firstOrCreate($data, $values);
    }

    /**
     * Get all record
     *
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($columns = ['*'])
    {
        return $this->model->all($columns);
    }

    /**
     * Query record by pagination
     *
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * Filling a entity and return, but don't save the database
     *
     * @param array $data
     * @return mixed
     */
    public function newModel(array $data)
    {
        return new $this->modelName($data);
    }

    /**
     * Return a new entity and save the database
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update a entity
     *
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = 'id')
    {
        return $this->model
            ->where($attribute, '=', $id)
            ->update($data);
    }

    /**
     * Delete a entity
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destory($id);
    }
}
