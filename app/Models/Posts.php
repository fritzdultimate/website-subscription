<?php

namespace App\Models;

use App\Jobs\SendSubscribtionEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Posts extends Model
{
    use HasFactory; 
    use Sluggable;

    protected $fillable = ['website_id', 'title', 'description', 'slug'];

    // public function user() {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    public function website() {
        return $this->belongsTo(Websites::class, 'website_id');
    }

    

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function boot() {
        parent::boot();
        self::created(function($model) {

            $subscribers = Subscribers::where('website_id', $model->website_id)->get();

            foreach($subscribers as $subscriber) {
                $details = [
                    'subject' => $model->title,
                    'description' => $model->description,
                    'date' => date("Y-m-d H:i:s"),
                    'view' => 'emails.newsletter',
                    'email' => $subscriber->user->email
                ];
    
                $emailJob = new SendSubscribtionEmail($details);
                dispatch($emailJob);
            }

            
        
            // $mailer = new \App\Mail\MailSender($details);
            // Mail::to($model->user->email)->send($mailer);
        });
    }

    
}
