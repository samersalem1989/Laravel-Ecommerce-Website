<?php

namespace App\Http\Services;

use App\Model\Tax;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Psr7\Request;
use App\Models\Order;

class PayService
{
    private $base_url;
    private $headers;
    private $request_client;

    /**
     * PayService constructor.
     * @param Client $request_client
     */

     public function __construct(Client $request_client)
     {
         $this->request_client = $request_client;
         $this->base_url = env('pay_base_url');
         $this->headers = [
             'Content-Type' =>  'application/json',
             'Authorization' =>  'Bearer' . env('GroupPrivateToken')
         ];
     }

     /**
      * @param $uri
      * @param $method
      * @param array $body
      * @return false|mixed
      * @throws \GuzzleHttp\Exception\GuzzleException
      */

      private function buildRequest($uri, $method, $data=[])
      {
          $request = new Request($method,$this->base_url . $uri,$this->headers);
          if(!$data)
            return false;
          $response = $this->request_client->send($request,[
              'json' => $data
          ]);


          if ($response->getStatusCode() != 200){
              return false;
          }
          $response = json_decode($response->getBody(),true);

          return redirect($response['URL']);
      }

      private function paymentStatusBuildRequest($uri, $method, $data=[],$IPNPost)
      {
          $request = new Request($method,$this->base_url . $uri,$this->headers);
          if(!$data)
            return false;
          $response = $this->request_client->send($request,[
              'json' => $data
          ]);


          if ($response->getStatusCode() != 200){
              return false;
          }
          $response = json_decode($response->getBody(),true);

          if($response['Status'] == 'NOTVERIFIED'){
            return file_put_contents('C:\xampp\htdocs\salem\eCommerce\NOTVERIFIED.txt',pritnt_r($response,true));
          }elseif($response['Status'] == 'VERIFIED'){
          Order::create([
                'SaleId'=> $IPNPost['SaleId'],
                'firstname'=> $IPNPost['CustomerFirstName'] ,
                'lastname'=> $IPNPost['CustomerLastName'],
                'city'=> $IPNPost['City'],
                'email'=> $IPNPost['EmailAddress'],
                'address'=> $IPNPost['Address'],
                'TransactionAmount'=> $IPNPost['TransactionAmount'],
                'DocumentURL'=> $IPNPost['DocumentURL'],
                'SaleTime'=> $IPNPost['SaleTime'],
                'TransactionCardName'=> $IPNPost['TransactionCardName'],
                'TransactionCardNum'=> $IPNPost['TransactionCardNum']
           ]);
         
         return file_put_contents('C:\xampp\htdocs\salem\eCommerce\zobor.txt',print_r($IPNPost,true));

          }
      }


       /**
        * @param $data
        */

      public function sendPayment($data)
      {
          return $response = $this->buildRequest('PaymentPageRequest.svc/GetUrl','POST',$data);
      }
      

      public function getPaymentStatus($data,$IPNPost)
      {
        return $response = $this->paymentStatusBuildRequest('PaymentPageRequest.svc/Verify','POST',$data,$IPNPost);
      }


}