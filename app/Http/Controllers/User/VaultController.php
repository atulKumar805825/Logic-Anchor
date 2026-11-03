<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserQuestionnaire;
use App\Models\VaultPayment;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;



class VaultController extends Controller
{
    public function vault()
    {
        if(empty(@auth()->user()->id))
        {
             return redirect(url('/login'))->with('error','You are Not login');
        }
        
        
        $user_id = auth()->user()->id;
        //print_r($user_id);die;
        $questionnaire = UserQuestionnaire::with(['user','vaultPayment','vaultPayments','phases'])->where('user_id',$user_id)->latest()->first();
        
        if(empty($questionnaire))
        {
            return redirect(url('https://static-pattern-348196.framer.app/'))->with('error','Your Quiz Not Found');
        }
        


        $subscription = VaultPayment::where('user_id', auth()->id())
            ->where('payment_status','paid')
            ->latest('billing_end')
            ->first();
        
        $phase = 0;
        
        if($questionnaire)
        {
        
            $initial = $questionnaire->phases->where('phase','initial_audit')->first();
            $stress = $questionnaire->phases->where('phase','stress_test')->first();
            $certificate = $questionnaire->phases->where('phase','certificate')->first();
        
            if($initial && $initial->status == 'active'){
                $phase = 1;
            }
        
            if($stress && $stress->status == 'active'){
                $phase = 2;
            }
        
            if($certificate && $certificate->status == 'active'){
                $phase = 3;
            }
        }
        
        $subscriptionActive = false;
        
        if($subscription && now()->lte($subscription->billing_end)){
            $subscriptionActive = true;
        }
        
        $certificate_data_result = false;
        if(!empty($questionnaire->certificate_data)){
            $certificate_data_result = true;
        }
        
        $questions = [
           "sovereignty" => "Do you currently use any AI tools in your clinical workflow?",
           "consent" => "Do you store patient data on AI provider servers?",
           "audit" => "Do you perform manual review of AI outputs?",
           "deletion" => "Is patient consent obtained for AI usage?",
           "insurance" => "Do you monitor AI model performance regularly?"
        ];
        
        
        return view('users.quiz.valut',compact('phase','subscriptionActive','questionnaire','certificate_data_result','questions','initial','stress','certificate'));
    }
    
    public function quiz()
    {
        return view('users.quiz.quiz');
    }
    
    public function quizPayment()
    {
        //print_r(session()->get('vault'));die;
        return view('users.quiz.payment');
    }
    
    public function startPayment(Request $request)
    {
        
        if(@$request->type == 'plan_expired')
        {
            $type = @$request->type;
            $questionnaire_id = @$request->questionnaire_id;
            return view('users.quiz.payment',compact('questionnaire_id','type'));
        }
        else
        {
            //session()->flush();
            // Delete old vault session if exists
            session()->forget('vault');
            
            session([
            'vault' => [
                'practice_name'   => $request->practice_name,
                'manager_name'    => $request->manager_name,
                'clinician_count' => $request->clinician_count,
                'date'            => $request->date,
                'email'           => $request->email,
                'score'           => $request->score,
                'answers'         => json_decode($request->answers, true)
            ]
        ]);
        
          return redirect()->route('user.payment');
        }
        
        //print_r(session()->get('vault'));die;
        
      
        // session([
        //     'vault.practice_name' => $request->practice_name,
        //     'vault.manager_name' => $request->manager_name,
        //     'vault.clinician_count' => $request->clinician_count,
        //     'vault.date' => $request->date,
        //     'vault.email' => $request->email,
        //     'vault.score' => $request->score,
        //     'vault.answers' => json_decode($request->answers,true)
        // ]);
    
        return redirect()->route('user.payment');
    }

    public function saveInitialAudit(Request $request)
    {
        $questions = [

            'q1' => [
                'title' => 'Data Sovereignty',
                'risk_title' => 'Risk Detected: Data Sovereignty',
                'risk_description' => 'Your AI provider may not store data on Australian-based servers. This may violate 2026 Privacy Act data residency requirements.'
            ],
        
            'q2' => [
                'title' => 'Patient Consent Protocols',
                'risk_title' => 'Risk Detected: Consent Protocol',
                'risk_description' => 'Your intake process may not include explicit patient consent for AI-assisted recording as required by OAIC health privacy guidelines.'
            ],
        
            'q3' => [
                'title' => 'Human-in-the-Loop',
                'risk_title' => 'Risk Detected: Human-in-the-Loop',
                'risk_description' => 'Your clinic does not have a documented policy requiring manual verification of AI-generated notes. This creates professional liability exposure.'
            ],
        
            'q4' => [
                'title' => 'Data Deletion Cycle',
                'risk_title' => 'Risk Detected: Data Retention',
                'risk_description' => 'Audio recordings may be stored longer than necessary. This increases compliance and insurance risk.'
            ],
        
            'q5' => [
                'title' => 'Credentialing',
                'risk_title' => 'Risk Detected: Credentialing',
                'risk_description' => 'Your clinicians may not be formally credentialed to use AI-assisted documentation systems.'
            ],
        
        ];

        $answers = [];
        $results = [];

        foreach ($questions as $key => $q) {

            $answer = $request->$key;

            $answers[$key] = $answer;

            if ($answer == 'Yes') {

                $results[] = [
                    'title' => $q['title'],
                    'status' => 'Compliant'
                ];

            } else {

                $results[] = [
                    'title' => $q['title'],
                    'status' => 'Risk Detected',
                    'risk_title' => $q['risk_title'],
                    'description' => $q['risk_description']
                ];
            }
        }

        UserQuestionnaire::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'client_name' => $request->client_name,
                'date' => $request->date,
                'practice_manager' => $request->practice_manager,
                'clinicians' => $request->clinicians,
                'answers' => $answers,
                'audit_result' => $results,
                'status' => 'logic_stress_test'
            ]
        );

        return redirect()->back()->with('success','Initial Audit Submitted');
    }

    public function downloadAudit()
    {
        return back()->with('success','Filefound');
        // $file = public_path('downloads/audit-report.pdf');

        // if(file_exists($file)){
        //     return response()->download($file);
        // }

        return back()->with('error','Filefound');
    }


    public function downloadCertificate()
    {
        return back()->with('success','Filefound');
        $file = public_path('downloads/governance-certificate.pdf');

        if(file_exists($file)){
            return response()->download($file);
        }

        return back()->with('error','File not found');
    }


    public function downloadStress()
    {
        return back()->with('success','Filefound');
        $file = public_path('downloads/stress-test-protocol.pdf');

        if(file_exists($file)){
            return response()->download($file);
        }

        return back()->with('error','File not found');
    }

    public function paymentSuccess()
    {
        $user = auth()->user();

        $user->vault_status = 'governance_certified';
        $user->save();

        return redirect()->route('vault.certification.complete');
    }

    public function paymentPage()
    {
        $user = Auth::user();
        $questionnaire = $user->questionnaire ?? null;

        if (!$questionnaire || $questionnaire->status !== 'logic_stress_test') {
            return redirect()->route('customer.dashboard')->with('error', 'You are not eligible for payment yet.');
        }

        return view('users.payment');
    }

    public function paymentSubmit(Request $request)
    {

        $request->validate([
            'plan' => 'required|in:small,medium,enterprise',
            //'payment_method' => 'required',
            //'payment_type' => 'required',
            'transaction_id' => 'nullable'
        ]);

        $user = Auth::user();

        $questionnaire = UserQuestionnaire::where('user_id',$user->id)->latest()->first();

        if(!$questionnaire){
            return back()->with('error','Questionnaire not found');
        }

        // plan pricing
        $amount = match ($request->plan) {
            'small' => 950,
            'medium' => 1950,
            'enterprise' => 3500,
        };

        // create payment
        VaultPayment::create([
            'user_id' => $user->id,
            'questionnaire_id' => $questionnaire->id,
            'plan' => $request->plan,
            'amount' => $amount,
            'payment_method' => $request->payment_method ?? 'Direct Bank Transfer',
            'payment_type' => $request->payment_type ?? 'Direct Bank Transfer',
            'transaction_id' => $request->transaction_id ?? 'TXN'.rand(100000,999999),
            'payment_status' => 'paid',
            'paid_at' => now()
        ]);

        // move questionnaire to step 3
        $questionnaire->status = 'governance_certified';
        $questionnaire->save();

        return redirect()
            ->route('customer.dashboard')
            ->with('success','Payment successful. Certification activated.');
    }


    public function generate(Request $request)
    {
        $page = $request->page_name;

        $user = Auth::user();

        $questionnaire = UserQuestionnaire::where('user_id', $user->id)
            ->latest()
            ->first();

        /* check if pdf already generated */

        if (!empty($questionnaire->certificate_data[$page])) {

            $path = $questionnaire->certificate_data[$page];

            return response()->download(storage_path('app/public/'.$path));
        }

        /* Prepare Data */

        $data = [
            'clinic_name' => $questionnaire->client_name,
            'date' => $questionnaire->date,
            'consultant_name' => 'Michael Smith',
            'principal_name' => 'Dr. John Doe',
            'practice_name' => $questionnaire->client_name,
        ];

        $data['doctor_name'] = $data['principal_name'];

        $data['month_year'] = \Carbon\Carbon::parse($data['date'])->format('F Y');

        /* Clean filename */

        $clinic = str_replace(' ', '_', trim($data['clinic_name']));
        $file_name = $clinic.'_'.$data['date'].'_'.$page.'.pdf';

        $path = 'pdf/'.$file_name;

        /* Generate PDF */

        $pdf = Pdf::loadView('pdf.'.$page, $data)
            ->setPaper('A4','portrait');

        /* Save PDF */

        Storage::disk('public')->put($path, $pdf->output());

        /* Save path in DB */

        $array = $questionnaire->certificate_data ?? [];
        $array[$page] = $path;

        $questionnaire->certificate_data = $array;
        $questionnaire->save();

        /* Download */
        return response()->download(storage_path('app/public/'.$path));

        //return $pdf->download($file_name);
    }
    
    public function downloadInventoryNew($id)
    {
        $userQuestionnaire = UserQuestionnaire::findOrFail($id);
    
        //print_r($userQuestionnaire);die;
    
        if($userQuestionnaire->file_status == 0){
            $userQuestionnaire->file_status = 1;
            $userQuestionnaire->save();
        }
    
        $path = storage_path('app/public/pdf/Logic-Anchor-Clinical-Inventory.pdf');
    
        return response()->download($path);
    }
    
    
}
