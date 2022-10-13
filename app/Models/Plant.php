<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;
    protected $fillable = [
      'common_name',
      'botanical_name',
      'plant_description',
      'temperature',
      'max_temperature',
      'humidity',
      'max_humidity',
      'soil_ph',
      'max_soil_ph',
      'min_light',
      'max_light',
      'nitrogen',
      'phosphorus',
      'potassium',
      'plant_type',
      'plant_image',

    ];

    public function Available(){
      return $this->hasOne(Available::class, 'plant_id', 'id');
    }


    public function getStatus(){
        return $this->hasOne('App\Models\Available');
    }
}
