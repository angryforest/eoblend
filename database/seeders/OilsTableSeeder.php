<?php

namespace Database\Seeders;

use App\Models\Oil;
use App\Models\Specification;
use App\Models\Compatibility;
use App\Models\Property;
use App\Models\OilProperty;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OilsTableSeeder extends Seeder {
    /**
     * Загрузка данных непосредственно касающихся эфирных масел
     *
     * @return void
     */
    public function run() {
        $oilsMap = [];

        // Заполняем таблицу масел и таблицу описаний на русском языке
        $oils = json_decode(file_get_contents('json/oils.json', true));
        foreach ($oils as $name => $oil) {
            $oilModel = Oil::create([
                'url'           => $name,
                'eng_name'      => $oil->name,
                'rus_name'      => $oil->rus_name,
                'volatility'    => $oil->volatility,
                'cover'         => '/img/oils/'.$name.'.jpg'
            ]);

            // Этот словарь поможет сопоставить имена с идентификаторами
            $oilsMap[$name] = $oilModel->id;
            $oilsMap[$oilModel->id] = $name;

            Specification::create([
                'oil_id'            => $oilModel->id,
                'language'          => 'rus',
                'title'             => 'Эфирное масло '.$oil->rus_genitive,
                'description'       => '', // TODO добавить описание для СЕО
                'plant'             => $oil->articles->catalog->plant,
                'aroma'             => $oil->articles->catalog->aroma,
                'properties'        => $oil->articles->catalog->properties,
                'methods'           => $oil->articles->catalog->methods,
                'contraindications' => $oil->articles->catalog->contraindications
            ]);

        }

        // Заполняем таблицу сочетаний между маслами
        foreach ($oils as $name => $oil) {
            foreach ($oil->compatibility as $pair) {
                Compatibility::create([
                    'oil_id' => $oilsMap[$name],
                    'pair_oil_id' => $oilsMap[$pair]
                ]);
            }
        }

        // Заполняем таблицу свойств и создаём привязки свойств к конретным маслам
        $properties = json_decode(file_get_contents('json/properties.json', true));
        foreach ($properties as $name => $property) {
            $propertyId = Property::create([
                'eng_name'      => $property->eng_name,
                'rus_name'      => $property->rus_name,
                'rus_description'    => $property->rus_description
            ]);


            foreach($property->oils as $oil) {
                OilProperty::create([
                    'oil_id'        =>  $oilsMap[$oil],
                    'property_id'   =>  $propertyId->id
                ]);
            }
        }
    }
}
