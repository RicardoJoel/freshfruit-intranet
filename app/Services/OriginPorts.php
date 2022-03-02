<?php

namespace App\Services;

use App\OriginPort;

class OriginPorts
{
    public function get()
    {
        $ports = OriginPort::orderBy('name','ASC')->get();
        $array = array();
        foreach ($ports as $port) {
            $array[$port->id] = $port->name;
        }
        return $array;
    }
}