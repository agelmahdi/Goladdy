<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{

    protected $fillable = [
        'name'
    ];

    public function zones(){
    return $this->belongsToMany(
        Zones::class,
        'instances_zones',
        'instance_id',
        'zone_id')->withPivot('active_zone');
    }
}
