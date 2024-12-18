<?php

namespace App\Models;
use App\Models\RequestServices;
use App\Models\RequestServicesOptions;
use Illuminate\Database\Eloquent\Model;

class RequestServicesSteps extends Model
{
    protected $table = 'request_services_steps';
    protected $fillable = ['request_services_id', 'step_title', 'step_description'];
    public function services()
    {
        return $this->belongsTo(RequestServices::class);
    }
    public function options()
    {
        return $this->hasMany(RequestServicesOptions::class);
    }
}