<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';
    
    protected $fillable = [
        'name'
    ];

    public function manifests()
    {
    	return $this->hasMany(Manifest::class);
    }

    public function users()
    {
    	return $this->belongsToMany(User::class)->wherePivotNull('deleted_at');
    }
}
