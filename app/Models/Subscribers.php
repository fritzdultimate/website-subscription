<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribers extends Model {
    use HasFactory;

    protected $fillable = ['user_id', 'website_id'];


    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function website() {
        return $this->belongsTo(Websites::class, 'website_id');
    }
}
