<?php

namespace App\Services;

use App\DestinyPort;

class DestinyPorts
{
    public function get()
    {
        $ports = DestinyPort::orderBy('name','ASC')->get();
        $array = array();
        foreach ($ports as $port) {
            $array[$port->id] = $port->name;
        }
        return $array;
    }
}