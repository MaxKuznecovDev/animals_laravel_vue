<?php


namespace App\Services;


use App\Models\BaseAnimals;
use App\Models\UserAnimals;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AminalsServices
{
    public function getAllAnimals(){
        $animals = BaseAnimals::all();
        if(!$animals){
            throw new ModelNotFoundException('Animals not found');
        }
        return $animals;
    }
    public function checkLifeAnimal(){
        $life_animal_arr = UserAnimals::where('status','life')->get();
            foreach ($life_animal_arr as $model){
                $model->status = 'dead';
                $model->save();
            }

    }
    public function createAnimal($request){
        $base_animal = BaseAnimals::where('id',$request->id)->first();
        if(!$base_animal){
            throw new ModelNotFoundException('Animal not found by ID ' . $request->id);
        }
        $user_animal = new UserAnimals();
        $user_animal->base_id = $base_animal->id;
        $user_animal->current_size = 0;
        $user_animal->current_age = 0;
        $user_animal->status = 'life';
        $user_animal->save();
        $user_animal_arr = [
            'id' => $user_animal->id,
            'current_size'=>0,
            'current_age'=>0,
            'status' =>'life',
            'name' => $base_animal->name,
            'kind' => $base_animal->kind,
            'size'=>$base_animal->size,
            'age'=>$base_animal->age,
            'growth'=>$base_animal->growth,
        ];

        return  $user_animal_arr;
    }
    public function saveStatus($request){

        $user_animal = UserAnimals::where('id',$request->id)->first();
        $user_animal->current_size = $request->current_size;
        $user_animal->current_age = $request->current_age;
        if($user_animal->status !== $request->status){
            $user_animal->status = $request->status;
        }
        $user_animal->save();
        return $this->checkStatus();

    }
    private function checkStatus(){
        $life_animal = UserAnimals::where('status','life')->count();
        if($life_animal){
            return ['status_life' => true];
        }else{
            return ['status_life' => false];
        }
    }
}
