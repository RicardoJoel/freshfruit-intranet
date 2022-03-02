<?php

namespace App\Services;

use App\Consignee;

class Consignees
{
    public function get()
    {
        $consignees = Consignee::orderBy('name','ASC')->get();
        $array = array();
        foreach ($consignees as $consignee) {
            $array[$consignee->id] = $consignee->name;
        }
        return $array;
    }
}