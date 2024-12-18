<?php

namespace App\Models;

use App\Models\RequestServicesSteps;
use Illuminate\Database\Eloquent\Model;

class RequestServicesOptions extends Model
{
    protected $table = 'request_services_options';
    protected $fillable = ['request_services_steps_id', 'size', 'time', 'price'];
    public function steps()
    {
        return $this->belongsTo(RequestServicesSteps::class);
    }

}