<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DestinyPort extends Model
{
    use SoftDeletes;

    protected $table = 'destiny_ports';
    
    protected $fillable = [
        'name'
    ];

    public function manifests()
    {
    	return $this->hasMany(Manifest::class);
    }
}
