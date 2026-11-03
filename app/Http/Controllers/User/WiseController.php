<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\WiseService;
use App\Models\Order;

class WiseController extends Controller
{

   public function get_access_token(Request $request)
   {
       return true;
   }
   
    public function checkout_page()
    {
        return view('checkout');
    }
    public function checkout(Request $request, WiseService $wise)
    {
        
//         $ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.transferwise.tech/v1/accounts');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


// $headers = array();
// $headers[] = 'Authorization: Bearer 88c1fadc-d8e5-4bb0-a38a-169cca3eb2b9';
// $headers[] = 'Content-Type: application/json';
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// $result = curl_exec($ch);
// if (curl_errno($ch)) {
//     echo 'Error:' . curl_error($ch);
// }
// curl_close($ch);
// print_r(json_decode($result));die;

        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.transferwise.tech/v1/profiles');
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        
        
        // $headers = array();
        // $headers[] = 'Authorization: Bearer 88c1fadc-d8e5-4bb0-a38a-169cca3eb2b9';
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        // $result = curl_exec($ch);
        // if (curl_errno($ch)) {
        //     echo 'Error:' . curl_error($ch);
        // }
        // curl_close($ch);
        // print_r(json_decode($result));die;

        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'amount'=>'required|numeric'
        ]);

        // 1️⃣ Create Order
        // $order = Order::create([
        //     'customer_name'=>$request->name,
        //     'customer_email'=>$request->email,
        //     'amount'=>$request->amount,
        //     'payment_method'=>'wise',
        //     'status'=>'pending'
        // ]);

        // 2️⃣ Create Quote
        $quote = $wise->createQuote($request->amount);

$wise_target_account = 702176271;
//print_r($quote);die;
        if(!isset($quote['id'])){
            return back()->with('error','Quote creation failed');
        }

if(empty(@$quote['id']))
{
   echo 'not wrl';die; 
}
        // 3️⃣ Create Transfer
        $transfer = $wise->createTransfer(
            $quote['id'],
            $wise_target_account,
          
        );


if(empty(@$transfer['id']))
{
    echo 'not wpk';
  print_r($transfer);die;
}
        if(!isset($transfer['id'])){
            return back()->with('error','Transfer creation failed');
        }
        
        
//        print_r($transfer);die;

        // // 4️⃣ Save transaction
        // $order->update([
        //     'transaction_id'=>$transfer['id']
        // ]);

        /*
        Wise hosted payment page
        */
        $paymentUrl = $transfer['paymentUrl'] ?? null;
        
        print_r($paymentUrl);die;

        if(!$paymentUrl){
            return back()->with('error','Payment URL not generated');
        }

        // 5️⃣ Redirect to Wise payment page
        return redirect($paymentUrl);
    }

    public function success()
    {
        return view('payments.success');
    }

    public function cancel()
    {
        return view('payments.cancel');
    }

}