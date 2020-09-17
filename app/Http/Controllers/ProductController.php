<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return 
     */
    public function index()
    {
        try {
            if (isset(request()->sort)) {
                $products = Product::orderBy('price', request()->sort)->paginate(8);
            } else {
                $products = Product::paginate(8);
            }
            return view('dashboard')->with('products', $products);
        } catch (Exception $exception) {
            return view('thankyou')->with(['type' => 'error', 'message' => 'Something went wrong, please try again!']);
        }
    }
}
