<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipper extends Model
{
    use SoftDeletes;

    protected $table = 'shippers';
    
    protected $fillable = [
        'name'
    ];

    public function manifests()
    {
    	return $this->hasMany(Manifest::class);
    }
}
