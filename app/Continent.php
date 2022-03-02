<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Continent extends Model
{
    use SoftDeletes;

    protected $table = 'continents';
    
    protected $fillable = [
        'name'
    ];

    public function countries()
    {
    	return $this->hasMany(Country::class);
    }
}
