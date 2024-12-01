<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeService extends Model
{
    protected $table = 'homeservice';
    protected $fillable = ['title', 'heading', 'description', 'image'];
}