<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Map extends Model
{
    use HasFactory, SoftDeletes, SoftCascadeTrait;

    protected $fillable = [
        'map_id',
        'name',
        'latitude',
        'longitude',
        'latitude_south_west',
        'longitude_south_west',
        'longitude_north_east',
        'latitude_north_east',
    ];
}
