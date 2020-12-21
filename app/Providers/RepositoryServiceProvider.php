<?php

namespace App\Providers;

use App\Repositories\OilRepository;
use App\Repositories\Interfaces\OilRepositoryInterface;
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
