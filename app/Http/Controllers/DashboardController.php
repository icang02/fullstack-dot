<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $countProduct = Product::all()->count();
        $countCategory = Category::all()->count();
        return view('dashboard', compact('countProduct', 'countCategory'));
    }
}
