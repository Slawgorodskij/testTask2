<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //$product =
        return view('home', [
            'title'=>'Каталог',
            'products'=>Product::all(),
        ]);
    }
}
