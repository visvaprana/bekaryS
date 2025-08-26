<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->get();
        return response()->json([
            'success' => true,
            'message' => '',
            'data' => $products,
        ]);
    }
}
