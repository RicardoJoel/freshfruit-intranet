<?php

namespace App\Services;

use App\Country;

class Countries
{
    public function get()
    {
        $countries = Country::orderBy('name','ASC')->get();
        $array = array();
        foreach ($countries as $country) {
            $array[$country->id] = $country->name;
        }
        return $array;
    }
}