<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\myOrder;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

$user= isset(Auth::user()->name) ? (Auth::user()->name) : 'Guest';

class UserController extends Controller
{


    public function getUser()
    {
       $userId = Auth::user()->id;
       $userInfo = User::where('id','=',$userId)->get();

       return $userInfo;
    }



    public function getUserInfo()
    {
        return view('profile');
    }



    // Update Authenticated user information for profile page
    public function postUserInfo(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required|string|min:3|max:20',
            'lastname' => 'required|string|min:3|max:20',
            'phone' => 'required|digits_between:9,10',
            'email' => 'required|email|string',
            'address' => 'required|string|min:3|max:50',
            'city' => 'required|string|min:3|max:20',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->has('image')) {
        $imageName = time().'.'.$request->image->extension();     
        $request->image->move(public_path('img'), $imageName);
        }else{
            $imageName = null;
        }


        $user = User::find($id);
        $review = Review::where('userId','=',$id);
        $user->name = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->city = $request->input('city');
        if ($user->profilePhoto != null && $imageName ==null){
        $user->profilePhoto = $user->profilePhoto;
        $review->profilePhoto = $review->profilePhoto;
        }else{
        $user->profilePhoto = $imageName;
        $review->update(['profilePhoto' => $imageName]);
        }
        $user->update();        

        return redirect()->back()->with('status','Updated Successfully')
                                 ->with('success','You have successfully upload image.')
                                 ->with('image',$imageName); 
    }


    // All Orders that the user made
    public function userOrders(Request $request)
    {
        $id = $request->input('id');
        $userOrders = myOrder::where('buyerId','=',"$id")->paginate(5);
        $userOrders->withPath("my-orders?id=$id");


        return view('user-orders', compact('userOrders'));
    }


    // Remove order from orders history by the user
    public function removeOrder(Request $request)
    {
        $id = $request->input('id');
        myOrder::where('id','=',"$id")->delete();        
    }

    // Add a review to product that user bought
    public function addReview(Request $request)
    {
        $userId = $request->userId;
        $productId = $request->productId;
        $userName = $request->userName;
        $text = $request->text;
        $ratingValue = $request->ratingValue;  
        $userImage = $request->userImage;


        Review::create([
            'userId'=> $userId,
            'productId'=> $productId ,
            'userName'=> $userName,
            'ratingValue'=> $ratingValue,
            'text'=> $text,
            'profilePhoto'=> $userImage
       ]);
    }
}
