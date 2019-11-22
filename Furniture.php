<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Furniture extends Model
{
    protected $fillable = [
        'title',
        'state',
        'typeintervention',
        'year',
        'quality',
        'totalcost',
        'actualcost'
    ];
}
