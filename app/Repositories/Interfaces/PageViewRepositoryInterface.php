<?php

namespace App\Repositories\Interfaces;

/**
 * 
 * Репозиторий инкапсулирует логику получения данных о просмотрах страниц
 *
 */
interface PageViewRepositoryInterface 
{
    public function pageViewList();
    public function pageViewStat();
}