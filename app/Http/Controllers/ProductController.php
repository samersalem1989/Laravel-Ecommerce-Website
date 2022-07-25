<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Offer;
use App\Models\Category;
use App\Models\myOrder;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class ProductController extends Controller
{
    // Home Page get all products from database
    public function getProducts()
    {
        $featuredProducts = Product::where('section','=','featured')->get();
        $newProducts = Product::where('section','=','new')->get();
        $inspiredProducts = Product::where('section','=','inspired')->get();
        $feautredOffer = Offer::where('section','=','featured')->get();
        $newOffer = Offer::where('section','=','new')->get();
        $reviews = Review::all();
        $orders = myOrder::all();
        
        return view('homepage', compact('featuredProducts','newProducts','feautredOffer',
        'newOffer','inspiredProducts','reviews','orders'));
    }

    // Single Product page 
    public function singleProduct(Request $request)
    {
        $id = $request->input('item');
        $onlyRequestedItem = Product::where('id','=',$id)->get();
        $cart = session()->get('cart', []);

    // Check if authenticated user buyed this Item so he can rate it
        if (Auth::check()) {
           $ordersId = myOrder::where('productId','=',$id)
                           ->where('buyerId', '=', Auth::user()->id)
                           ->get();
        }else{
            $ordersId = 0;
        }

        $ordersCount = myOrder::where('productId','=',$id)->count();
        $reviews = Review::where('productId','=',$id)->get();

    // Calculating rating average
        if(count($reviews)>0){
                $reviewsTotal =0;
                for ($i=0;$i<count($reviews);$i++){
                    $reviewsTotal += $reviews[$i]['ratingValue'];
                }
                $average =$reviewsTotal / count($reviews);
                $reviewsAverage = number_format((float) $average, 1);
           }else{
            $reviewsAverage=null;
           }
    
    // If buyer added this item already to cart or not 
        if(isset($cart[$id])) {
            $quantity = $cart[$id]['quantity'];
            $main_btnText = 'fa fa-check';
            $main_btnCss = "pointer-events: none; cursor: default;font-size:15px;line-height:27px;padding:0px 12px;";
            $disabled = "disabled";
            $itemsCountCss = "pointer-events: none; cursor: default;";
            $hidden = "show";
        } else {
            $quantity = 1;
            $main_btnText = 'fa fa-shopping-cart';
            $main_btnCss = "pointer-events: auto; cursor: pointer;font-size:15px;line-height:27px;padding:0px 12px;";
            $disabled = "enabled";
            $itemsCountCss = "pointer-events: auto; cursor: pointer;";
            $hidden = "hidden";
        }

        
        return view('single-product',compact('quantity','onlyRequestedItem',
        'main_btnText','main_btnCss','disabled','itemsCountCss','hidden','ordersId',
        'reviews','reviewsAverage','ordersCount'));
    }

    // Single product page - Adding amount of the product - maximum 10 !
    public function singleQtyPlus(Request $request)
    {
        $id = $request->input('item');
        $onlyRequestedItem = Product::where('id','=',$id)->get();
        $quantity = $request->input('qty');
        if($quantity < 10){
            $quantity = $quantity+1;
        }else{
            $quantity = 10;
        }
        return view('single-product',compact('onlyRequestedItem','quantity'));
    }

    // Single product page - Decrease amount of the product - minimum 1 !
    public function singleQtyMinus(Request $request)
    {
        $id = $request->input('item');
        $onlyRequestedItem = Product::where('id','=',$id)->get();
        $quantity = $request->input('qty');
        if($quantity > 1){
            $quantity = $quantity-1;
        }else{
            $quantity = 1;
        }
        return view('single-product',compact('onlyRequestedItem','quantity'));
    }

    // End of single product Page


    // Cart page
    public function cart()
    {
        return view('cart');
    }


    // Add to Cart From home page
    public function addToCart(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

            $cart[$id] = [

                "id" => $id,
                "title" => $product->title,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image,
                "description" => $product->description
            ];
        session()->put('cart', $cart);
    }

    // Add to cart from single product page- if already added you can change the amount from this page
    public function addSingleProductToCart(Request $request)

    {
        $id = $request->id;
        $quantity = $request->quantity;
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']= $quantity;

        } else {

            $cart[$id] = [

                "id" => $id,
                "title" => $product->title,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image,
                "description" => $product->description
            ];
        }

        session()->put('cart', $cart);
    }


    
    // Buy Now from home page
    public function buyNow(Request $request)

    {
        $id = $request->input('item');
        $quantity = $request->input('qty');
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] == $cart[$id]['quantity'];
        } else {

            $cart[$id] = [

                "id" => $id,
                "title" => $product->title,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image,
                "description" => $product->description
            ];
        }

        session()->put('cart', $cart);
        return redirect('checkout');
    }


    // Buy Now from single product page
    public function singleProductbuynow(Request $request)

    {
        $id = $request->id;
        $quantity = $request->quantity;
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] == $cart[$id]['quantity'];
        } else {

            $cart[$id] = [

                "id" => $id,
                "title" => $product->title,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image,
                "description" => $product->description
            ];
        }

        session()->put('cart', $cart);
        return redirect('checkout');
    }


    // Cart page adding amount of the products
    public function updatePlus(Request $request)
    {

        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            if ($cart[$request->id]["quantity"] < 10)
            {
                $cart[$request->id]["quantity"] = $request->quantity + 1;
            }else{
            $cart[$request->id]["quantity"] = 10;
            }

            session()->put('cart', $cart);
        }
    }

    // Cart page decreasing amount of the products
    public function updateMinus(Request $request)

    {

        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            if ($cart[$request->id]["quantity"] > 1)
            {
                $cart[$request->id]["quantity"] = $request->quantity - 1;
            }else{
            $cart[$request->id]["quantity"] = 1;
            }

            session()->put('cart', $cart);
        }
   
    }

    // Cart page remove a product
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
    }

    // All Categories
    public function categories()
    {
        $categories = Category::all();
        return view('categories',compact('categories'));
    }

    // Get a specific category
    public function getCategory(Request $request)
    {
        $categoryName = $request->input('name');   
        $categories = Category::all();
        $products = Product::where('category','=',$categoryName)->get();
        return view('category',compact('products','categories','categoryName'));

    }

}
