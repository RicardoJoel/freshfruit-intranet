<?php

namespace App\Services;

use App\Consignee;
use Carbon\Carbon;

class Months
{
    public function get()
    {
        $months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre'];
        $cur_year = Carbon::now()->year;
        $cur_month = Carbon::now()->month;
        $array = array();
        for ($i=0; $i<12; $i++) {
            $aux = ($cur_month + $i) % 12;
            $ano = $cur_year - ($aux >= $cur_month ? 1 : 0);
            $array[$ano.str_pad($aux+1,2,'0',STR_PAD_LEFT)] = $months[$aux].' '.$ano;
        }
        return $array;
    }

    public function getAll()
    {
        $months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre'];
        $cur_year = Carbon::now()->year;
        $cur_month = Carbon::now()->month;
        $array = array();
        for ($ano=2020; $ano<$cur_year; $ano++)
            for ($mes=0; $mes<12; $mes++)
                $array[$ano.str_pad($mes+1,2,'0',STR_PAD_LEFT)] = $months[$mes].' '.$ano;
        for ($mes=0; $mes<$cur_month; $mes++)
                $array[$ano.str_pad($mes+1,2,'0',STR_PAD_LEFT)] = $months[$mes].' '.$ano;
        return $array;
    }
}