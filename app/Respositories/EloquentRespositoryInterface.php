<?php namespace App\Respositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Interface EloquentRespositoryInterface
 * @package App\Respositories
 */

 interface EloquentRespositoryInterface {

   /**
    * @return Collection
    */
   public function all() : Collection;
   /**
   * @param array $attributes
   * @return Model
   */

   public function create(array $attributes): Model;

   /**
    * @param $id
    * @return Model
    */

   public function find($id): ?Model;

   /**
    * @param $id
    * @return Model
    */

    public function findOrFail($id): ?Model;

   /**
    * @param array $where_clause
   * @param array $attributes
   * @return Model
   */

   public function update(array $where_clause, array $attributes): Model;


  public function delete();

   /**
    * @return Collection
    */

   public function getLastInsertedId() : int;

   /**
    * @return Collection
    */

    public function getLastInserted() : Collection;
 }