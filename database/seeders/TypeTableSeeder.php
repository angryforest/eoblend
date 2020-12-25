<?php

namespace Database\Seeders;

use App\Models\Oil;
use App\Models\Type;
use App\Models\OilType;
use App\Models\TypeData;

use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    public function run()
    {
    	$oilsMapByName = Oil::getMapByName();

        $types = json_decode(file_get_contents('json/types.json', true));
        foreach ($types as $name => $type) 
        {
            $newType = Type::create([
                'name' => $name,
            ]);

            foreach ($type->name as $lang => $value) {
                TypeData::create([
                    'type_id'   => $newType->id,
                    'language'	=> $lang,
                    'name' 		=> $type->name->$lang,
                ]);
            }

            // Одно масло может относиться к нескольким типам
            foreach($type->oils as $oil) 
            {
                OilType::create([
                    'oil_id'    =>  $oilsMapByName[$oil]->id,
                    'type_id'	=>  $newType->id,
                ]);
            }
        }
    }
}
