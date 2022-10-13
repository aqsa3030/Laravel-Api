<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reg_Nursery extends Model
{
    use HasFactory;
    protected $fillable = [

        'nur_name',
        'nur_own_name',
        'phone_num',
        'email',
        'web_link',
        'password',
       ];
}
