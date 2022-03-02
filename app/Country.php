<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    protected $table = 'countries';
    
    protected $fillable = [
        'continent_id', 'name'
    ];

    public function continent()
    {
    	return $this->belongsTo(Continent::class);
    }

    public function manifests()
    {
    	return $this->hasMany(Manifest::class);
    }
}
