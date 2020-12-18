<?php

namespace App\Repositories\Interfaces;

/**
 * 
 * Репозиторий инкапсулирует логику получения ряда моделей связанных с маслами 
 *
 */
interface OilRepositoryInterface {
    public function oilList(): object;
    public function propertyList(): object;
    public function oilPropertyMap(): array;
    public function getOilData($name): object;
    public function oilCompatibilityMap(): array;
}