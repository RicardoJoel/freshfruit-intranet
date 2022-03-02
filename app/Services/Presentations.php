<?php

namespace App\Services;

use App\Presentation;

class Presentations
{
    public function get()
    {
        $presentations = Presentation::orderBy('name','ASC')->get();
        $array = array();
        foreach ($presentations as $presentation) {
            $array[$presentation->id] = $presentation->name;
        }
        return $array;
    }
}