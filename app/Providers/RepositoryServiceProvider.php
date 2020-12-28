<?php

namespace App\Providers;

use App\Repositories\OilRepository;
use App\Repositories\Interfaces\OilRepositoryInterface;

use App\Repositories\PageViewRepository;
use App\Repositories\Interfaces\PageViewRepositoryInterface;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider 
{
    // Массовый bind
    public $bindings = [
        OilRepositoryInterface::class => OilRepository::class,
        PageViewRepositoryInterface::class => PageViewRepository::class,
    ];

    /**
     * Связывание сервис-контейнеров
     *
     * @return void
     */
    public function register() 
    {
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() 
    {

    }
}
