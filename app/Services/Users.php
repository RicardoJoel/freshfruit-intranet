<?php

namespace App\Services;

use App\User;

class Users
{
    public function get()
    {
        $users = User::where('id','!=','1')->orderByRaw('name ASC', 'lastname ASC')->get();
        $array = array();
        foreach ($users as $user) {
            $array[$user->id] = [
                'name' => $user->name.' '.$user->lastname,
                'is_blocked' => $user->is_blocked
            ];
        }
        return $array;
    }
}