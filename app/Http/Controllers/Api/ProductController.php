<?php

namespace App\Http\Controllers\Api;
 use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index($storeId)
    {
        $products = Product::where('store_id', $storeId)->get();
        return response()->json($products); 
    }
}
