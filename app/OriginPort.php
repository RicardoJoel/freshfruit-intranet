<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OriginPort extends Model
{
    use SoftDeletes;

    protected $table = 'origin_ports';
    
    protected $fillable = [
        'name'
    ];

    public function manifests()
    {
    	return $this->hasMany(Manifest::class);
    }
}
