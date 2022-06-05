<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseAnimals extends Model
{
    use HasFactory;
    protected $table = 'base_animals';
    public function base()
    {
        return $this->hasMany(UserAnimals::class,'base_id');
    }
}
