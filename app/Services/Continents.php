<?php

namespace App\Services;

use App\Continent;

class Continents
{
    public function get()
    {
        $continents = Continent::orderBy('name','ASC')->get();
        $array = array();
        foreach ($continents as $continent) {
            $array[$continent->id] = $continent->name;
        }
        return $array;
    }
}