<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    public function index() {
        // $products = Products::all();
        $products = Products::paginate(3);

        return view('pages.products',compact('products'));
    }

    public function show($id) {
        $product = Products::findOrFail($id);
        return view('pages.product-detail',  compact('product'));
    }
}