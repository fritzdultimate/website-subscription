<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Websites extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'total_subscribers'];

    // public static function boot() {
    //     parent::boot();
    //     self::created(function($model) {
    //         $model->total_subscribers = ++$model->total_subscribers;
    //         // $model->update();
    //     });
    // }

}
