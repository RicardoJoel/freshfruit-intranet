<?php

namespace App\Services;

use App\Shipper;

class Shippers
{
    public function get()
    {
        $shippers = Shipper::orderBy('name','ASC')->get();
        $array = array();
        foreach ($shippers as $shipper) {
            $array[$shipper->id] = $shipper->name;
        }
        return $array;
    }
}