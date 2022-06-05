<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AminalsServices;
use Illuminate\Http\Request;

class AnimalsController extends Controller
{


    public function get_all_animals(AminalsServices $service)
    {

        $animals = $service->getAllAnimals();
        return $animals;
    }
    public function check_life_animal(AminalsServices $service)
    {
        $animals = $service->checkLifeAnimal();
        return $animals;
    }
    public function create_animal(AminalsServices $service, Request $request){
        $animal = $service->createAnimal($request);
        return $animal;
    }
    public function save_status(AminalsServices $service, Request $request){
        return $service->saveStatus($request);
    }

}
