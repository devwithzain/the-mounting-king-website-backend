<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $table = 'table_slot';
    protected $fillable = ['title', 'description', 'days', 'timings', 'is_active'];
}