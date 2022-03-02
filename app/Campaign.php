<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use SoftDeletes;

    protected $table = 'campaigns';
    
    protected $fillable = [
        'start_at', 'end_at', 'product_id'
    ];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
