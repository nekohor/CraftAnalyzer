<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unstable extends Model
{
    protected $fillable = [
        'line'       ,
        'start_date' ,
        'shift'      ,
        'duty'       ,
        'area'       ,
        'catego'     ,
        'steel_grade',
        'coil_id'    ,
        'aim_thick'  ,
        'aim_width'  ,
        'events'     ,
        'describe'   ,
    ];
}
