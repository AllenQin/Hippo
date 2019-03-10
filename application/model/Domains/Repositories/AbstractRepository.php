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
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
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
     * @param array $data
     * @return mixed
     */
    public function firstOrCreate(array $data)
    {
        return $this->model->firstOrCreate($data);
    }

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($columns = ['*'])
    {
        return $this->model->all($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function newModel(array $data)
    {
        return new $this->modelName($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
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
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destory($id);
    }
}
