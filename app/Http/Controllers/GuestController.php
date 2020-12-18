<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\OilRepositoryInterface;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller {

    private $oilRepository;

    public function __construct(OilRepositoryInterface $oilRepository) {
        parent::__construct();

        $this->oilRepository = $oilRepository;

        $this->data['oils'] = $this->oilRepository->oilList();
        $this->data['properties'] = $this->oilRepository->propertyList();
        $this->data['oilProperties'] = $this->oilRepository->oilPropertyMap();
        $this->data['compatibility'] = $this->oilRepository->oilCompatibilityMap();
    }

    public function getHome() {
        $this->data['currentPage'] = 'home';
        $this->data['title'] = 'Калькулятор эфирных масел';
        $this->data['description'] = 'Калькулятор поможет составить аромакомпозицию на основе таблицы комплиментарности и ваших предпочтений';
        return view('guest.index', $this->data);
    }

    public function getHtmlOils() {
        $this->data['currentPage'] = 'oilList';
        $this->data['title'] = 'Справочник эфирных масел';
        $this->data['description'] = 'В справочнике описаны ароматы, полезные свойства, методы применения, противопоказания и сочетания';
        return view('guest.index', $this->data);
    }

    public function getHtmlOil($name) {
        $this->data['currentPage'] = 'oilItem';
        $this->data['currentItem'] = $name;
        $this->data['oil'] = $this->oilRepository->getOilData($name);
        $this->data['title'] = $this->data['oil']->title;
        $this->data['description'] = $this->data['oil']->plant;
        return view('guest.index', $this->data);
    }

    public function getJsonOil($name) {
        return response()->json($this->oilRepository->getOilData($name));
    }
}
