<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advantage extends Model
{
    protected $table = 'advantage';
    protected $fillable = ['title', 'subTitle', 'serviceTitle1', 'serviceTitle2', 'serviceTitle3', 'serviceDescription1', 'serviceDescription2', 'serviceDescription3', 'serviceImage1', 'serviceImage2', 'serviceImage3'];
}