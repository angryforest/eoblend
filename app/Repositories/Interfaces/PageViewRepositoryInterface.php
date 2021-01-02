<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
/**
 * 
 * Репозиторий инкапсулирует логику получения данных о просмотрах страниц
 *
 */
interface PageViewRepositoryInterface 
{
    public function pageViewList();
    public function pageViewStat();
    public function pageViewStatByUrl(Request $request);
}