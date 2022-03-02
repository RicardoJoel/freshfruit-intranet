<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manifest extends Model
{
    use SoftDeletes;

    protected $table = 'manifests';
    
    protected $fillable = [
        'product_id',
        'presentation_id',
        'country_id',
        'origin_port_id',
        'destiny_port_id',
        'shipper_id',
        'consignee_id',
        'is_organic',
        'departured_at',
        'code',
        'ship',
        'variety',
        'company',
        'brand',
        'detail',
        'knowledge',
        'processing',
        'description',
        'master_direct',
        'gross_weight',
        'origin_weight',
        'received_weight',
        'manifested_weight',
        'packages',
        'origin_packages',
        'received_packages',
        'manifested_packages',
        'terminal',
        'total_detail',
        'container_size',
        'container_qnty'
    ];

    public function country()
    {
    	return $this->belongsTo(Country::class);
    }

    public function originPort()
    {
    	return $this->belongsTo(OriginPort::class);
    }

    public function destinyPort()
    {
    	return $this->belongsTo(DestinyPort::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function presentation()
    {
    	return $this->belongsTo(Presentation::class);
    }

    public function shipper()
    {
    	return $this->belongsTo(Shipper::class);
    }

    public function consignee()
    {
    	return $this->belongsTo(Consignee::class);
    }
}
