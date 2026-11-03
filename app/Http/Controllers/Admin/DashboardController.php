<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserQuestionnaire;
use App\Models\VaultPayment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $stats = [];

        /* -------------------------
        Total Users
        --------------------------*/
        $stats['total_users'] = User::count();


        /* -------------------------
        Payment Pending
        --------------------------*/
        $stats['payment_pending'] = VaultPayment::where('payment_status','pending')->count();


        /* -------------------------
        Revenue
        --------------------------*/
        $stats['total_revenue'] = VaultPayment::where('payment_status','paid')->sum('amount');

        
        //$totalQuestionnaireUsers = UserQuestionnaire::count();
        
        // $phaseCounts = UserQuestionnaire::withCount([
            
        //     // count users with active initial audit
        //     'phases as initial_audit_active' => function($q){
        //         $q->where('phase','initial_audit')
        //           ->where('status','active');
        //     },
        
        //     // stress test
        //     'phases as stress_test_active' => function($q){
        //         $q->where('phase','stress_test')
        //           ->where('status','active');
        //     },
        
        //     // certificate
        //     'phases as certificate_active' => function($q){
        //         $q->where('phase','certificate')
        //           ->where('status','active');
        //     },
        
        // ])->get();
        
        
        // $stats = [
        //     'initial_audit' => $totalQuestionnaireUsers - $activeCounts['initial_audit'],
        //     'stress_test'   => $totalQuestionnaireUsers - $activeCounts['stress_test'],
        //     'certificate'   => $totalQuestionnaireUsers - $activeCounts['certificate'],
        // ];
        


        /* -------------------------
        Monthly Certifications
        --------------------------*/
        $months = UserQuestionnaire::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('month')
            ->pluck('total','month');

        $data = [];

        for ($i = 1; $i <= 12; $i++) {
            $data[$i] = $months[$i] ?? 0;
        }

        $stats['monthBookingsChart'] = collect($data);


        return view('backend.dashboard', compact('stats'));
    }
}