<?php

namespace Database\Seeders;

use App\Models\Oil;
use App\Models\OilData;
use App\Models\Compatibility;

use Illuminate\Database\Seeder;

class OilTableSeeder extends Seeder 
{
    public function run() 
    {
        $oilsMapById = [];
        $oilsMapByName = [];

        // Заполняем таблицу масел и таблицу описаний на русском языке
        $oils = json_decode(file_get_contents('json/oils.json', true));
        foreach ($oils as $name => $oil) 
        {
            $newOil = Oil::create([
                'name'          => $name,
                'volatility'    => $oil->volatility,
            ]);

            foreach ($oil->articles->catalog->name as $lang => $value) {
                OilData::create([
                    'oil_id'            => $newOil->id,
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

            // Эти словари помогут сопоставить имена с идентификаторами
            $oilsMapById[$newOil->id] = $newOil;
            $oilsMapByName[$name] = $newOil;
        }

        // Заполняем таблицу сочетаний между маслами
        foreach ($oils as $name => $oil) 
        {
            foreach ($oil->compatibility as $pair) 
            {
                Compatibility::create([
                    'oil_id' => $oilsMapByName[$name]->id,
                    'pair_oil_id' => $oilsMapByName[$pair]->id,
                ]);
            }
        }
    }
}
