<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PayService;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\myOrder;



class PayController extends Controller
{
    private $payService;

    public function __construct(PayService $payService)
    {
        $this->payService = $payService;
    }


    public function payOrder(Request $request)
    {
        $orders = session()->get('cart', []);
        $request->validate([
            'firstname' => 'required|string|min:3|max:20',
            'lastname' => 'required|string|min:3|max:20',
            'phone' => 'required|digits_between:9,10',
            'email' => 'required|email|string',
            'address' => 'required|string|min:3|max:50',
            'city' => 'required|string|min:3|max:20'
        ]);

       

        $data = [
            "GroupPrivateToken" => "80d75f51-1ca1-41a8-a698-8183d68499c6",
            "Items" => array(),
            
            "RedirectURL"=> "http://localhost:8000/thankyou",
            "IPNURL" => "https://c43f-2a0d-6fc0-69b-f700-410-7649-817a-6e68.ngrok.io/api/callback",
            "FailRedirectURL"=>"http://youtube.com",
            "DocumentLanguage"=> 'he',
            "Currency"=> 1,
            "PhoneNumber"=>$request->input('phone'),
            "EmailAddress"=>$request->input('email'),
            "CustomerFirstName"=>$request->input('firstname'),
            "CustomerLastName"=>$request->input('lastname'),
            "Address" => $request->input('address'),
            "City" => $request->input('city'),
            "SendMail" => true,
            "NumberOfPayments" => 1
        ];


        foreach ($orders as $id => $order)
        {
            $data['Items'][]= array(
                "Quantity" => $order['quantity'],
                "UnitPrice" => $order['price'],
                "Description" => $order['title']
            );


            if (Auth::check()) {
                $userId= Auth::user()->id;
                $email = Auth::user()->email;
                $user= isset(Auth::user()->name);
                $total = $order['price'] * $order['quantity'] . '.00';
                
                myOrder::create([
                    'buyerId' => $userId,
                    'buyerName' => $user,
                    'buyerEmail' => $email,
                    'firstname' => $request->input('firstname'),
                    'lastname' => $request->input('lastname'),
                    'email' => $request->input('email'),
                    'productId'=> $order['id'],
                    'title'=> $order['title'] ,
                    'quantity'=> $order['quantity'],
                    'price'=> $order['price'],
                    'total'=> $total,
                    'image'=> $order['image'],
                    'description'=> $order['description'],
               ]);
            }
        }


        return $this->payService-> sendPayment($data);  
        
    }

   public function checkout()
    {
        if(Auth::check()){
            $userId = Auth::user()->id;
            $userInfo = User::where('id','=',$userId)->get();
            
            $userData=[
                'userId' => $userInfo[0]['id'],
                'userName' => $userInfo[0]['name'],
                'userLastname' => $userInfo[0]['lastname'],
                'userEmail' => $userInfo[0]['email'],
                'userAddress' => $userInfo[0]['address'],
                'userCity' => $userInfo[0]['city'],
                'userPhone' => $userInfo[0]['phone'],
            ];

        }else{

            $userData=[
                'userId' => '',
                'userName' => '',
                'userLastname' => '',
                'userEmail' => '',
                'userAddress' => '',
                'userCity' => '',
                'userPhone' => '',
            ];
        }
        return view('checkout',compact('userData'));

     }


     public function paymentCallBack(Request $request)
     {
        $raw_post_data = $request->getContent();
        $raw_post_array = explode('&', $raw_post_data);
        $IPNPost = array();
        foreach ($raw_post_array as $keyval) {
            $keyval = explode ('=', $keyval);
            if (count($keyval) == 2)
                $IPNPost[$keyval[0]] = urldecode($keyval[1]);
        }

        $data = [];
        $data["GroupPrivateToken"] = $IPNPost['GroupPrivateToken'];
        $data["SaleId"] = $IPNPost['SaleId'];
        $data["TotalAmount"] = $IPNPost['TransactionAmount'];
        
        return $this->payService->getPaymentStatus($data,$IPNPost);
     }

    public function thankyou()
    {
        return view('thankyou');
    }

}
