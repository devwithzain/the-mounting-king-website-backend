<?php

namespace App\Models;

use App\Models\RequestServicesSteps;
use Illuminate\Database\Eloquent\Model;

class RequestServices extends Model
{
    protected $table = 'request_services';
    protected $fillable = ['service_title', 'service_description'];

    public function steps()
    {
        return $this->hasMany(RequestServicesSteps::class);
    }

}