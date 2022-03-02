<?php

namespace App\Services;

use App\Product;
use Carbon\Carbon;
use Auth;
use DB;

class Products
{
    public function get()
    {
        $products = Auth::user()->products()->orderBy('name','ASC')->get();
        $array = array();
        foreach ($products as $product) {
            $array[$product->id] = $product->name;
        }
        return $array;
    }

    public function getAll()
    {
        $products = Product::orderBy('name','ASC')->get();
        $array = array();
        foreach ($products as $product) {
            $array[$product->id] = $product->name;
        }
        return $array;
    }

    public function getInCampaign()
    {
        $products = Product::distinct()
        ->select([
            'products.id',
            'products.name'
        ])
        ->leftJoin('campaigns','campaigns.product_id','products.id')
        ->where(
            DB::raw('(month(current_date) + if(month(current_date) < month(campaigns.start_at),12,0))'),'<=',
            DB::raw('(month(campaigns.end_at) + if(month(campaigns.end_at) < month(campaigns.start_at),12,0))')
        )
        ->orderBy('name','ASC')
        ->get();

        $array = array();
        foreach ($products as $product) {
            $array[$product->id] = $product->name;
        }
        return $array;
    }
}