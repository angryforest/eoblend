<?php

namespace Database\Seeders;

use App\Models\Oil;
use App\Models\Specification;
use App\Models\Compatibility;
use App\Models\Property;
use App\Models\OilProperty;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OilsTableSeeder extends Seeder 
{
    /**
     * Загрузка данных непосредственно касающихся эфирных масел
     *
     * @return void
     */
    public function run() 
    {
        $oilsMap = [];

        // Заполняем таблицу масел и таблицу описаний на русском языке
        $oils = json_decode(file_get_contents('json/oils.json', true));
        foreach ($oils as $name => $oil) 
        {
            $oilModel = Oil::create([
                'url'           => $name,
                'volatility'    => $oil->volatility,
                'cover'         => '/img/oils/'.$name.'.jpg',
            ]);

            // Этот словарь поможет сопоставить имена с идентификаторами
            $oilsMap[$name] = $oilModel->id;
            $oilsMap[$oilModel->id] = $name;

            foreach ($oil->articles->catalog->name as $lang => $value) {
                Specification::create([
                    'oil_id'            => $oilModel->id,
                    'language'          => $lang,
                    'name'              => $oil->articles->catalog->name->$lang,
                    'title'             => $oil->articles->catalog->genitive->$lang,
                    'description'       => '', // TODO добавить описание для СЕО
                    'plant'             => $oil->articles->catalog->plant->$lang,
                    'aroma'             => $oil->articles->catalog->aroma->$lang,
                    'properties'        => $oil->articles->catalog->properties->$lang,
                    'methods'           => $oil->articles->catalog->methods->$lang,
                    'contraindications' => $oil->articles->catalog->contraindications->$lang,
                ]);
            }
        }

        // Заполняем таблицу сочетаний между маслами
        foreach ($oils as $name => $oil) 
        {
            foreach ($oil->compatibility as $pair) 
            {
                Compatibility::create([
                    'oil_id' => $oilsMap[$name],
                    'pair_oil_id' => $oilsMap[$pair],
                ]);
            }
        }

        // Заполняем таблицу свойств и создаём привязки свойств к конретным маслам
        $properties = json_decode(file_get_contents('json/properties.json', true));
        foreach ($properties as $name => $property) 
        {
            $propertyId = Property::create([
                'eng_name'      => $property->name->en,
                'rus_name'      => $property->name->ru,
                'rus_description'    => $property->description->ru,
            ]);


            foreach($property->oils as $oil) 
            {
                OilProperty::create([
                    'oil_id'        =>  $oilsMap[$oil],
                    'property_id'   =>  $propertyId->id,
                ]);
            }
        }
    }
}
