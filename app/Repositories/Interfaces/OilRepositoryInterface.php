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
    public function propertyList();
    public function oilPropertyMap();
    public function getOilData($name);
    public function oilCompatibilityMap();
}