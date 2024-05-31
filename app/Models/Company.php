<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes, SoftCascadeTrait;
        protected $fillable = [
            'user_id',
            'name',
            'city',
            'address',
            'image',
            'description',
            'active'
        ];
}
