<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consignee extends Model
{
    use SoftDeletes;

    protected $table = 'consignees';
    
    protected $fillable = [
        'name'
    ];

    public function manifests()
    {
    	return $this->hasMany(Manifest::class);
    }
}
