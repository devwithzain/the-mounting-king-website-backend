<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroRequest extends Model
{
    protected $table = 'request_hero';
    protected $fillable = ['title'];

}