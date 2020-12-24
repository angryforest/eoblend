<?php

namespace App\Repositories;

use App\Models\Oil;
use App\Models\Property;
use App\Models\OilProperty;
use App\Models\Compatibility;
use App\Models\Specification;

use App\Repositories\Interfaces\OilRepositoryInterface;

class OilRepository implements OilRepositoryInterface 
{
    // TODO Оптимизировать через кэш
    public function oilList(): object 
    {
        $specification = Specification::select(['oil_id', 'name', 'language'])->get();
        $specificationByOilId = [];
        foreach ($specification as $spec)
            $specificationByOilId[$spec->oil_id][$spec->language] = $spec->name;

        $oils = Oil::all();
        foreach ($oils as $index => $oil)
            $oils[$index]->name = $specificationByOilId[$oil->id];

        return $oils;
    }

    // TODO передовать и выводить список комплиментарных масел 
    public function getOilData($name): object 
    {
        $oil = Oil::where(['url' => $name])->first();

        $specification = Specification::where(['oil_id' => $oil->id])->get();
        $specificationByLang = [];
        foreach ($specification as $spec)
            $specificationByLang[$spec->language] = $spec;

        $oil->specification = $specificationByLang;

        return $oil;
    }

    public function oilCompatibilityMap(): array 
    {
        $map = [];
        foreach (Compatibility::all() as $item) 
        {
            if(!@$map[$item->oil_id])
                $map[$item->oil_id] = [];
            $map[$item->oil_id][] = $item->pair_oil_id;
        }
        return $map;
    }

    public function propertyList(): object 
    {
        return Property::all();
    }

    public function oilPropertyMap(): array 
    {
        $map = [];
        foreach (OilProperty::all() as $item) 
        {
            if(!@$map[$item->oil_id])
                $map[$item->oil_id] = [];
            $map[$item->oil_id][$item->property_id] = true;
        }
        return $map;
    }
}