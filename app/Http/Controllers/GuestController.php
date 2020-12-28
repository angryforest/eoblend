<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\OilRepositoryInterface;
use App\Models\Oil;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    private $oilRepository;

    public function __construct(OilRepositoryInterface $oilRepository) 
    {
        parent::__construct();
        $this->oilRepository = $oilRepository;
    }

	public function getJsonOil($name) 
	{
        return response()->json($this->oilRepository->oilData($name));
    }

    public function getJsonOils() 
    {
        return response()->json([
            'oils' => $this->oilRepository->oilList(),
            'types' => $this->oilRepository->typeList(),
            'properties' => $this->oilRepository->propertyList(),
        ]);
    }


    public function test() 
    {
        var_dump('<pre>');
        var_dump(json_decode(json_encode(

        Oil::all()->flatMap(function($item) { 
            return [$item->name => $item];
        })

        )));
        var_dump('</pre>');

    }
}
