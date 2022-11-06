<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zones extends Model
{

protected $fillable = [
        'name'
    ];

public function instances(){
    return $this->belongsToMany(
            Instance::class,
            'instances_zones',
            'zone_id',
            'instance_id')->withPivot('active_zone');
    }
}
