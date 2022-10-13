<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Available extends Model
{
    use HasFactory;
    protected $fillable = [
      'plant_id',
      'plant_available',

    ];

    public function StatusAvail(){

      return $this->belongsTo('App\Models\Plant');
    }

}
