<?php namespace App\Respositories\Eloquents;

use App\Models\Websites;
use App\Respositories\WebsiteRespositoryInterface;
use Illuminate\Support\Collection;

class WebsiteRespository extends BaseRespository implements WebsiteRespositoryInterface {

    /**
     * @var Model
     */

     protected $model;

    /**
     * @param User $model
     */

    public function __construct(Websites $model) {
        $this->model = $model;
        parent::__construct($model);
    }

    public function list(array $where_clause, array $items): Collection {
        return $this->model->where($where_clause)->select($items)->get();
    }

    public function lookForData(array $attributes): Collection {
        return $this->model->where($attributes)->first();
    }
}


