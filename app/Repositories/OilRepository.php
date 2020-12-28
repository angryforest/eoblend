<?php

namespace App\Repositories;

use App\Models\Oil;
use App\Models\Type;
use App\Models\Property;

use Illuminate\Support\Facades\Cache;
use App\Repositories\Interfaces\OilRepositoryInterface;

class OilRepository implements OilRepositoryInterface 
{
    public function oilList() 
    {
        return Cache::rememberForever('oils', function() { 
            return Oil::with([
                'data:oil_id,name,language', 
                'types.type', 'properties', 
                'compatibility'
            ])->get()->map(function($item) { 

                // Передаём минимум данных с сервера
                $data = $item->data->flatMap(function($lang) { 
                    $locale = $lang->language;
                    unset($lang->language);
                    return [$locale => $lang]; 
                });

                // TODO Переписать на стрелочные функции после установки нового PHP
                $types = $item->types->map(function($type) { return $type->type->name; });
                $properties = $item->properties->map(function($prop) { return $prop->property_id; });
                $compatibility = $item->compatibility->map(function($prop) { return $prop->pair_oil_id; });

                // PHP...
                unset(
                    $item->data, 
                    $item->types, 
                    $item->properties, 
                    $item->compatibility
                );

                $item->data = $data;
                $item->types = $types;
                $item->properties = $properties;
                $item->compatibility = $compatibility;
                
                return $item;
            });
        });
    }

    // TODO выводить ещё типы, свойства, список комплиментарных масел 
    public function oilData($name) 
    {
        return Cache::remember('oil_'.$name, 60, function() use($name) { 

            $item = Oil::with(['data'])
                    ->where(['name' => $name])
                    ->first();

            $data = $item->data->flatMap(function($lang) { 
                $locale = $lang->language;
                unset($lang->language);
                return [$locale => $lang]; 
            });

            unset($item->data);
            $item->data = $data;
                
            return $item;

        });
    }

    public function propertyList() 
    {
        return Cache::rememberForever('properties', function() { 
            return Property::with(['data'])->get()->map(function($item) { 

                $data = $item->data->flatMap(function($lang) { 
                    $locale = $lang->language;
                    unset($lang->language);
                    return [$locale => $lang]; 
                });

                unset($item->data);
                $item->data = $data;
                
                return $item;
            });
        });
    }

    public function typeList() 
    {
        return Cache::rememberForever('types', function() { 
            return Type::with(['data'])->get()->map(function($item) { 

                $data = $item->data->flatMap(function($lang) { 
                    $locale = $lang->language;
                    unset($lang->language);
                    return [$locale => $lang]; 
                });

                unset($item->data);
                $item->data = $data;
                
                return $item;
            });
        });
    }
}