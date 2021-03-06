<?php

namespace App\Repositories\Interfaces;

/**
 * 
 * Репозиторий инкапсулирует логику получения ряда моделей связанных с маслами 
 *
 */
interface OilRepositoryInterface 
{
    public function oilList();
    public function oilData($name);
    public function typeList();
    public function propertyList();
}