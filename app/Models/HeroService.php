<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroService extends Model
{
    protected $table = 'service_hero';
    protected $fillable = ['title'];

}