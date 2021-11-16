<?php namespace App\Respositories\Eloquents;

use App\Models\User;
use App\Respositories\UserRespositoryInterface;
use Illuminate\Support\Collection;

class UserRespository extends BaseRespository implements UserRespositoryInterface {
    /**
     * @var Model
     */

     protected $model;

    /**
     * @param User $model
     */

     public function __construct(User $model) {
         $this->model = $model;
         parent::__construct($model);
     }

      public function list(array $where_clause, array $items): Collection {
          return $this->model->where($where_clause)->select($items)->get();
      }
}


