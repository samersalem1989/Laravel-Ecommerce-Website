<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'query'=> 'required|min:3'
        ]);
        $query = $request->input('query');

        $products = Product::search($query)->paginate(10);
        
        return view('search-results', compact('products'));
    }
}
