<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\User;
use App\Models\UserQuestionnaire;
use App\Models\VaultPayment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class StripeController extends Controller
{
    
    public function checkout(Request $request)
    {
    
        $prices = [
        'small'=>950,
        'medium'=>1950,
        'enterprise'=>3500
        ];
        
        $amount = $prices[$request->plan];
        
        session([
        'selected_plan'=>$request->plan,
        'plan_amount'=>$amount
        ]);
        
        //print_r(session()->get('vault'));die;
        
        $secret = \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        //Stripe::setApiKey(config('services.stripe.secret'));
        
        Stripe::setApiKey($secret);
       
        
        if(!empty(@$request->type) && @$request->type == 'plan_expired')
        {
            
            $prices = [
                'small'=>99,
                'medium'=>199,
                'enterprise'=>399
                ];
                
              $amount = $prices[$request->plan];
        
            $type = @$request->type;
            
                $checkout = Session::create([

                'payment_method_types'=>['card'],
            
                'line_items'=>[
                    [
                        'price_data'=>[
                            'currency'=>'aud',//usd
                            'product_data'=>[
                                'name'=>'Vault Certification '.$request->plan
                            ],
                            'unit_amount'=>$amount*100
                        ],
                        'quantity'=>1
                    ]
                ],
            
                'mode'=>'payment',
            
                'metadata'=>[
                    'type'=>$type,
                    'questionnaire_id'=>$request->questionnaire_id,
                    'plan' => $request->plan,
                    'amount' => $amount,

                ],
            
                'success_url'=>route('stripe.success').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url'=>route('stripe.cancel'),
            
            ]);
            
        }
        else {
                
                $checkout = Session::create([

                'payment_method_types'=>['card'],
            
                'line_items'=>[
                    [
                        'price_data'=>[
                            'currency'=>'aud',//usd
                            'product_data'=>[
                                'name'=>'Vault Certification '.$request->plan
                            ],
                            'unit_amount'=>$amount*100
                        ],
                        'quantity'=>1
                    ]
                ],
            
                'mode'=>'payment',
            
                'metadata'=>[
                    'email'=>session('vault.email'),
                    'practice_name'=>session('vault.practice_name'),
                    'manager'=>session('vault.manager_name'),
                    'clinicians'=>session('vault.clinician_count'),
                    'date'=>session('vault.date'),
                    'answers'=>json_encode(session('vault.answers')),
                    'plan' => $request->plan,
                    'amount' => $amount,

                ],
            
                'success_url'=>route('stripe.success').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url'=>route('stripe.cancel'),
            
            ]);
        }
        
        
        // $checkout = Session::create([
        
        // 'payment_method_types'=>['card'],
        
        // 'line_items'=>[
        // [
        // 'price_data'=>[
        // 'currency'=>'usd',
        // 'product_data'=>[
        // 'name'=>'Vault Certification '.$request->plan
        // ],
        // 'unit_amount'=>$amount*100
        // ],
        // 'quantity'=>1
        // ]
        // ],
        
        // 'mode'=>'payment',
        
        // 'success_url'=>route('stripe.success').'?session_id={CHECKOUT_SESSION_ID}',
        
        // 'cancel_url'=>route('stripe.cancel'),
        
        // ]);
        // $checkout = Session::create([

        //         'payment_method_types'=>['card'],
            
        //         'line_items'=>[
        //             [
        //                 'price_data'=>[
        //                     'currency'=>'aud',//usd
        //                     'product_data'=>[
        //                         'name'=>'Vault Certification '.$request->plan
        //                     ],
        //                     'unit_amount'=>$amount*100
        //                 ],
        //                 'quantity'=>1
        //             ]
        //         ],
            
        //         'mode'=>'payment',
            
        //         'metadata'=>[
        //             'email'=>session('vault.email'),
        //             'practice_name'=>session('vault.practice_name'),
        //             'manager'=>session('vault.manager_name'),
        //             'clinicians'=>session('vault.clinician_count'),
        //             'date'=>session('vault.date'),
        //             'answers'=>json_encode(session('vault.answers')),
        //             'plan' => $request->plan,
        //             'amount' => $amount,

        //         ],
            
        //         'success_url'=>route('stripe.success').'?session_id={CHECKOUT_SESSION_ID}',
        //         'cancel_url'=>route('stripe.cancel'),
            
        //     ]);
        
        return redirect($checkout->url);
    
    }
    
   

    public function success(Request $request)
    {
    
    
        $secret = \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        //Stripe::setApiKey(config('services.stripe.secret'));
        
        Stripe::setApiKey($secret);
        
        $session = Session::retrieve($request->session_id);
        
        $stripeTransaction = $session->payment_intent;
       
        
        $meta = $session->metadata;

        /*
        |--------------------------------------------------------------------------
        | 1️⃣ Create User (NO PASSWORD YET)
        |--------------------------------------------------------------------------
        */
        //print_r($meta);die;
        
        if(!empty(@$meta->type) && @$meta->type == 'plan_expired')
        {
            /*
            |--------------------------------------------------------------------------
            | 3️⃣ Save Payment
            |--------------------------------------------------------------------------
            */
            
            $userQuestionnaire = UserQuestionnaire::with('user')->where('id',$meta->questionnaire_id)->first();
            $user = $userQuestionnaire->user;
           
            
            VaultPayment::create([
    
            'user_id'=>$userQuestionnaire->user->id,
            'questionnaire_id'=>$userQuestionnaire->id,
            'payment_method'=>'stripe',
            'payment_type'=>'stripe',
            'transaction_id'=>$session->payment_intent,
            'amount' => $meta->amount,
            'plan' => $meta->plan,
            'payment_status'=>'paid',
            'paid_at'=>now(),
            'billing_start' => now(),
            'billing_end'  => now()->addMonth(),
            
            ]);
            
            
            return redirect(url('/vault'))->with('success','Your Plan SuccessFully Updated');

        }
        else
        {
            $user = User::firstOrCreate(
    
                ['email' => $meta->email],
            
                [
                    'name' => $meta->practice_name,
                    'password' => Hash::make(Str::random(10))
                ]
            
            );
            
             
            //print_r($meta);die;
            
            // $user = User::firstOrCreate(
            
            //     ['email' => session('vault.email')],
            
            //     [
            //         'name' => session('vault.practice_name'),
            //         'password' => Hash::make(Str::random(10))
    
            //     ]
            
            // );
            
            
            /*
            |--------------------------------------------------------------------------
            | 2️⃣ Save Questionnaire
            |--------------------------------------------------------------------------
            */
            
            $audit_result = $this->generateAuditResults(json_decode($meta->answers));
    
            $questionnaire = UserQuestionnaire::updateOrCreate(
            
                ['user_id'=>$user->id],
            
                [
                    'client_name'=>$meta->practice_name,
                    'date'=>$meta->date,
                    'practice_manager'=>$meta->manager,
                    'clinicians'=>$meta->clinicians,
                    'answers'=>json_decode($meta->answers,true),
                    'audit_result'=>$audit_result,
                    'status'=>'logic_stress_test'
                ]
            
            );
            // $audit_result = $this->generateAuditResults(session('vault.answers')) ?? [];
            
            // $questionnaire = UserQuestionnaire::updateOrCreate(
            
            //     ['user_id' => $user->id],
            
            //     [
            //         'client_name' => session('vault.practice_name'),
            //         'date' => session('vault.date'),
            //         'practice_manager' => session('vault.manager_name'),
            //         'clinicians' => session('vault.clinician_count'),
            //         'answers' => session('vault.answers'),
            //         'audit_result' => $audit_result,
            //         'status' => 'logic_stress_test'
            //     ]
            
            // );
            
            
            /*
            |--------------------------------------------------------------------------
            | 3️⃣ Save Payment
            |--------------------------------------------------------------------------
            */
            
            // VaultPayment::create([
            
            // 'user_id' => $user->id,
            // 'questionnaire_id' => $questionnaire->id,
            // 'payment_type' => 'stripe',
            // 'payment_method' => 'stripe',
            // 'transaction_id' => $stripeTransaction,
            // 'amount' => session('plan_amount'),
            // 'plan' => session('selected_plan'),
            // 'payment_status' => 'paid',
            // 'paid_at'=>date('Y-m-d')
            
            // ]);
            
            VaultPayment::create([
    
            'user_id'=>$user->id,
            'questionnaire_id'=>$questionnaire->id,
            'payment_method'=>'stripe',
            'payment_type'=>'stripe',
            'transaction_id'=>$session->payment_intent,
            'amount' => $meta->amount,
            'plan' => $meta->plan,
            'payment_status'=>'paid',
            'paid_at'=>now(),
            'billing_start' => now(),
            'billing_end'  => now()->addMonth(),
            
            ]);
        
        }
        
        
        /*
        |--------------------------------------------------------------------------
        | 4️⃣ Show Success Page
        |--------------------------------------------------------------------------
        */
        
        return view('users.quiz.success',[
        'email' => $user->email
        ]);
        
    }
    
    private function generateAuditResults($answers)
    {
         
        $questions = [
    
            'sovereignty' => [
                'title' => 'Data Sovereignty',
                'risk_title' => 'Risk Detected: Data Sovereignty',
                'risk_description' => 'Your AI provider may not store data on Australian-based servers. This may violate 2026 Privacy Act data residency requirements.'
            ],
    
            'consent' => [
                'title' => 'Patient Consent Protocols',
                'risk_title' => 'Risk Detected: Consent Protocol',
                'risk_description' => 'Your intake process may not include explicit patient consent for AI-assisted recording as required by OAIC health privacy guidelines.'
            ],
    
            'audit' => [
                'title' => 'Human-in-the-Loop',
                'risk_title' => 'Risk Detected: Human-in-the-Loop',
                'risk_description' => 'Your clinic does not have a documented policy requiring manual verification of AI-generated notes. This creates professional liability exposure.'
            ],
    
            'deletion' => [
                'title' => 'Data Deletion Cycle',
                'risk_title' => 'Risk Detected: Data Retention',
                'risk_description' => 'Audio recordings may be stored longer than necessary. This increases compliance and insurance risk.'
            ],
    
            'insurance' => [
                'title' => 'Credentialing',
                'risk_title' => 'Risk Detected: Credentialing',
                'risk_description' => 'Your clinicians may not be formally credentialed to use AI-assisted documentation systems.'
            ]
    
        ];
    
        $results = [];
    
        foreach ($answers as $key => $answer) {
    
            if ($answer !== 'Yes') {
    
                if(isset($questions[$key])){
    
                    $q = $questions[$key];
    
                    $results[] = [
                        'title' => $q['title'],
                        'status' => 'Risk Detected',
                        'risk_title' => $q['risk_title'],
                        'description' => $q['risk_description']
                    ];
                }
            }
        }
    
        return $results;
    
    }

    
    public function cancel()
    {
        return view('users.quiz.failed');
    }
    
    public function createAccount(Request $request)
    {
    
        $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed'
        ],[
        'password.confirmed' => 'Password and Confirm Password do not match.'
        ]);
        
        $user = User::where('email', $request->email)->first();
        
        if(!$user){
        return redirect()->back()->with('error','User not found');
        }
        
        $user->update([
        'password' => Hash::make($request->password)
        ]);
        
        auth()->login($user);
        
        return redirect('/vault');
    
    }
}