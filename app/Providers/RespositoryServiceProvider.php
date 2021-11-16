<?php

namespace App\Providers;

use App\Respositories\EloquentRespositoryInterface;
use App\Respositories\Eloquents\BaseRespository;
use App\Respositories\Eloquents\WebsiteRespository;
use App\Respositories\WebsiteRespositoryInterface;
use Illuminate\Support\ServiceProvider;

class RespositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRespositoryInterface::class, BaseRespository::class);
        $this->app->bind(WebsiteRespositoryInterface::class, WebsiteRespository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
