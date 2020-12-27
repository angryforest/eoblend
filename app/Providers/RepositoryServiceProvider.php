<?php

namespace App\Providers;

use App\Repositories\OilRepository;
use App\Repositories\Interfaces\OilRepositoryInterface;

use App\Repositories\PageViewRepository;
use App\Repositories\Interfaces\PageViewRepositoryInterface;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider 
{
    /**
     * Связывание сервис-контейнеров
     *
     * @return void
     */
    public function register() 
    {
        $this->app->bind(
            OilRepositoryInterface::class, 
            OilRepository::class
        );

        $this->app->bind(
            PageViewRepositoryInterface::class, 
            PageViewRepository::class
        );
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
