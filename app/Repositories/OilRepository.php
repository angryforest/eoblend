<?php

namespace App\Repositories;

use App\Models\Oil;
use App\Models\Property;
use App\Models\OilProperty;
use App\Models\Compatibility;
use App\Models\OilData;
use App\Models\PropertyData;

use App\Repositories\Interfaces\OilRepositoryInterface;

class OilRepository implements OilRepositoryInterface 
{
    // TODO Прописать связи таблиц в моделях
    // TODO Оптимизировать через кэш
    public function oilList(): object 
    {
        $oilData = OilData::select(['oil_id', 'name', 'language'])->get();
        $oilDataByOilId = [];
        foreach ($oilData as $data)
            $oilDataByOilId[$data->oil_id][$data->language] = $data->name;

        $oils = Oil::all();
        foreach ($oils as $index => $oil)
            $oils[$index]->data = ['name' => $oilDataByOilId[$oil->id]];

        return $oils;
    }

    // TODO передавать и выводить список комплиментарных масел 
    public function getOilData($name): object 
    {
        $oil = Oil::where(['name' => $name])->first();

        $oilData = OilData::where(['oil_id' => $oil->id])->get();
        $oilDataByLang = [];
        foreach ($oilData as $data)
            $oilDataByLang[$data->language] = $data;

        $oil->data = $oilDataByLang;

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

    // TODO Прописать связи таблиц в моделях
    public function propertyList(): object 
    {
        $propertyData = PropertyData::all();
        $propertyDataByPropertyId = [];
        foreach ($propertyData as $data)
            $propertyDataByPropertyId[$data->property_id][$data->language] = $data;

        $properties = Property::all();
        foreach ($properties as $index => $property)
            $properties[$index]->data = $propertyDataByPropertyId[$property->id];

        return $properties;
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