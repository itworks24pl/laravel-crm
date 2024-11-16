<?php

namespace VentureDrake\LaravelCrm\Http\Controllers;

use VentureDrake\LaravelCrm\Models\ProductReturn;

class ProductReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prodreturns = ProductReturn::all();
        return view('laravel-crm::product-return.index', [
            'prodreturns' => $prodreturns
        ]);
    }
}
