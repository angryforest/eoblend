<?php

namespace App\Logics\Interfaces;

use Illuminate\Http\Request;
/**
 * 
 * Инкапсулирует логику записи данных о просмотрах страниц
 *
 */
interface PageViewLogicInterface 
{
    public function postPageView(Request $request);
}