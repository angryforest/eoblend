<?php

namespace Database\Seeders;

use App\Models\Oil;
use App\Models\Property;
use App\Models\OilProperty;
use App\Models\PropertyData;

use Illuminate\Database\Seeder;

class PropertyTableSeeder extends Seeder
{
    public function run()
    {
    	$oilsMapByName = Oil::getMapByName();

        $properties = json_decode(file_get_contents('json/properties.json', true));
        foreach ($properties as $name => $property) 
        {
            $newProperty = Property::create([
                'name' => $name,
            ]);

            foreach ($property->name as $lang => $value) {
                PropertyData::create([
                    'property_id'        => $newProperty->id,
                    'language'      => $lang,
                    'name'          => $property->name->$lang,
                    'description'	=> $property->description->$lang,
                ]);
            }

            // Одно масло может иметь несколько свойств
            foreach($property->oils as $oil) 
            {
                OilProperty::create([
                    'oil_id'        =>  $oilsMapByName[$oil]->id,
                    'property_id'   =>  $newProperty->id,
                ]);
            }
        }
    }
}
