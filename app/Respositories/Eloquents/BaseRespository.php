<?php
namespace App\Respositories\Eloquents;

use App\Respositories\EloquentRespositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRespository implements EloquentRespositoryInterface {
    /**
     * @var Model
     */

    protected $model;

    /**
     * BaseRespository constructor
    * @param Model $model
    */

    public function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * @return Collection
    */

    public function all(): Collection {
        return $this->model->all();
    }

    /**
     * @param array $attributes
     * 
     * @return Model
     */

    public function create(array $attributes): Model {
        return $this->model->create($attributes);
    }

    /**
    * @param $id
    * @return Model
    */

    public function find($id): ?Model {
        return $this->model->find($id);
    }

    /**
    * @param $id
    * @return Model
    */

    public function findorFail($id): ?Model {
        return $this->model->findorFail($id);
    }

    /**
    * @param array $where_clause
    * @param array $attributes
    * @return Model
    */

    public function update(array $where_clause, array $attributes): Model {
        return $this->model->where($where_clause)->update($attributes);
    }

    /**
     * @return int
     */

    public function getLastInsertedId(): int {
        return $this->model->latest()->first()->id;
    }

    /**
     * @return Collection
     */

    public function getLastInserted(): Collection {
        return $this->model->latest()->first();
    }

    

    public function delete() {
        return $this->model->delete();
    }
}