<?php

namespace App\Providers;

use App\Logics\PageViewLogic;
use App\Logics\Interfaces\PageViewLogicInterface;

use Illuminate\Support\ServiceProvider;

class LogicServiceProvider extends ServiceProvider 
{
    // Массовый bind
    public $bindings = [
        PageViewLogicInterface::class => PageViewLogic::class,
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
