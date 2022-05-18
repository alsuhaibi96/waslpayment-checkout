<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

class apiTestController extends Controller
{
    

  /**
   * This function is used to show the success page with the amount and the other details
   */
  public function showTest(){
    $info = Route::current()->parameter('info');
   
     // $data=json_decode($info);
     $info=base64_decode($info); 
    
      $data=json_decode($info,true);

 foreach($data as $index => $opt){
  $status=$data['status'];   
  $products=$data['products'];
  $order_reference=$data['order_reference'];
  $customer_info=$data['customer_account_info'];
  $meta_data=$data['meta_data'];

 }
foreach($customer_info as $info=>$value){
  $paid_amount=$customer_info['paid_amount'];
  $card_holder=$customer_info['card_holder'];
  $card_type=$customer_info['card_type'];
  $created_at=$customer_info['created_at'];
  $updated_at=$customer_info['updated_at'];


}
     
 
 $meta_data=json_decode($meta_data,true);
  $created_at=date('g:ia',strtotime($created_at));   

 return view('paymentViews.testResponse',compact('paid_amount','status','card_holder','order_reference','card_type','meta_data','created_at'));
 }
 
 /**
    * This function is used to show the cancel page with
    * @param cancel 
    */
 public function testCancel(){
 
   $cancel = Route::current()->parameter('cancel');
 
   // return $cancel;
   return view('paymentViews.cancel_payment',compact('cancel'));
 
 }
 
 public function viewCancel(){
 
  
   return view('paymentViews.cancel_payment');
 
 }
 
 
 /**
  * The index function which is used for posting the data to the api
  */
     public function index(){
         $data = [
             "order_reference" => "123412",
             
             "products" => [
               array(
                 "id" => 1,
                 "product_name" => "charger",
                 "quantity" => 1,
                 "unit_amount" => 1000
               ),
               array(
                 "id" => 5,
                 "product_name" => "iphone",
                 "quantity" => 2,
                 "unit_amount" => 100000
               ),
            
             ],
              "currency" => "YER",
             "total_amount" => 111000,
             "success_url" => "http://127.0.0.1:8080/test/response",
             "cancel_url" => "http://127.0.0.1:8080/test/cancel",
             "metadata" => [
               "Customer name" => "somename",
               "order_id" => 0
             ]
       
           ];
       
       
       
       
           $curl = curl_init();
       
           curl_setopt_array($curl, array(
             CURLOPT_URL => "https://waslpayment.com/api/test/merchant/payment_order",
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => "",
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 30000,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => "POST",
             CURLOPT_POSTFIELDS => json_encode($data),
       
             CURLOPT_HTTPHEADER => array(
            
               "private-key: rRQ26GcsZzoEhbrP2HZvLYDbn9C9et",
               "public-key: HGvTMLDssJghr9tlN9gr4DVYt0qyBy",
               "Content-Type:  application/x-www-form-urlencoded"
       
       
             ),
           ));
       
           $response = curl_exec($curl);
           $err = curl_error($curl);
       
           curl_close($curl);
       
           if ($err) {
             echo " Error #:" . $err;
           } else {
             echo $response;
         
       
           }
       
     }
}
