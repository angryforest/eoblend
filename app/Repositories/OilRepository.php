<?php

namespace App\Repositories;

use App\Models\Oil;
use App\Models\Type;
use App\Models\OilData;
use App\Models\OilType;
use App\Models\Property;
use App\Models\TypeData;
use App\Models\PropertyData;
use App\Models\OilProperty;
use App\Models\Compatibility;

use App\Repositories\Interfaces\OilRepositoryInterface;

class OilRepository implements OilRepositoryInterface 
{
    // TODO Прописать связи таблиц в моделях
    // TODO Оптимизировать через кэш
    public function oilList() 
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
    public function oilData($name) 
    {
        $oil = Oil::where(['name' => $name])->first();

        $oilData = OilData::where(['oil_id' => $oil->id])->get();
        $oilDataByLang = [];
        foreach ($oilData as $data)
            $oilDataByLang[$data->language] = $data;

        $oil->data = $oilDataByLang;

        return $oil;
    }

    public function oilCompatibilityMap() 
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
    public function propertyList() 
    {
        $propertyData = PropertyData::all();
        $propertyDataByPropertyId = [];
        foreach ($propertyData as $data)
            $propertyDataByPropertyId[$data->property_id][$data->language] = $data;

        $properties = Property::all();
        $res = [];
        foreach ($properties as $index => $property) {
            $res[$property->id] = $property;
            $res[$property->id]->data = $propertyDataByPropertyId[$property->id];
        }

        return $properties;
    }

    public function typeList() 
    {
        $typeData = TypeData::all();
        $typeDataByTypeId = [];
        foreach ($typeData as $data)
            $typeDataByTypeId[$data->type_id][$data->language] = $data;

        $types = Type::all();
        $res = [];
        foreach ($types as $index => $type) {
            $res[$type->id] = $type;
            $res[$type->id]->data = $typeDataByTypeId[$type->id];
        }

        return $types;
    }

    public function oilPropertyMap() 
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

    public function oilTypeMap() 
    {
        $map = [];
        foreach (OilType::all() as $item) 
        {
            if(!@$map[$item->oil_id])
                $map[$item->oil_id] = [];
            $map[$item->oil_id][$item->type_id] = true;
        }
        return $map;
    }
}