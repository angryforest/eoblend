<?php

namespace App\Providers;

use App\Logics\PageViewLogic;
use App\Logics\Interfaces\PageViewLogicInterface;

use Illuminate\Support\ServiceProvider;

class LogicServiceProvider extends ServiceProvider 
{
    /**
     * Связывание сервис-контейнеров
     *
     * @return void
     */
    public function register() 
    {
        $this->app->bind(
            PageViewLogicInterface::class, 
            PageViewLogic::class
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
