<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backEnd.dashboard.index',[
            'products_count'=> Product::all()->count(),
            'users_count'=> User::all()->count(),
            'categories_count'=> Category::all()->count(),
        ]);
    }
}