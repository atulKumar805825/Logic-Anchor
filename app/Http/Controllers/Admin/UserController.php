<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserQuestionnaire;
use App\Models\VaultPayment;
use App\Models\VaultPhase;
use Illuminate\Support\Facades\Storage;



class UserController extends Controller
{

    // Users List
     public function index(Request $request)
    {
        $query = User::with('questionnaire')
            ->where('role', '!=', 'admin');

        // Search filter
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->paginate(10);

        return view('backend.users.index', compact('users'));
    }


    // View User
    public function show($id)
    {
        $user = User::with(['questionnaire.vaultPayment','questionnaire.vaultPayments','questionnaire.phases'])->findOrFail($id);

        $vaultPayment = null;

        if ($user->questionnaire && $user->questionnaire->vaultPayment) {
            // Existing payment found
            $vaultPayment = $user->questionnaire->vaultPayment;
        } else {
            // No payment exists yet
            $vaultPayment = null;
        }

        return view('backend.users.show', compact('user'));
    }


    // Edit User Page
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('backend.users.edit', compact('user'));
    }


    // Update User
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required',
            'email' => 'required|email'
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role
        ]);

        return redirect()->route('admin.users')
            ->with('success','User updated successfully');
    }


    // Delete User
    public function destroy($id)
    {
        $user = User::findOrFail($id);
    
        $user->delete(); // Soft delete
    
        return redirect()
            ->route('admin.users')
            ->with('success', 'User deleted successfully.');
    }
    
    public function updateQuestionnaireStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:initial_audit,logic_stress_test,governance_certified,rejected',
        ]);
    
        $status = $request->status;
    
        $questionnaire = UserQuestionnaire::findOrFail($id);
    
        if ($status == 'initial_audit') {
    
            // Delete questionnaire and payment
            $questionnaire->delete();
    
            VaultPayment::where('questionnaire_id', $id)->delete();
    
            return redirect()->back()->with('success', 'Questionnaire reset to initial audit.');
        }
    
        if ($status == 'logic_stress_test') {
    
            $questionnaire->certificate_data = null;
            $questionnaire->payment_status = 'pending';
            $questionnaire->save();
    
            // delete payment
            VaultPayment::where('questionnaire_id', $id)->delete();
        }
        
        
    
        // Update status
        $questionnaire->update([
            'status' => $status,
        ]);
    
        return redirect()->back()->with('success', 'Questionnaire status updated successfully.');
    }
    
    public function phaseUpload(Request $request)
    {
    
        $userQuestionnaire = UserQuestionnaire::where('id',$request->questionnaire_id)->first();
        $request->validate([
        'questionnaire_id' => 'required',
        'phase' => 'required'
        ]);
        
        $phase = VaultPhase::where([
        'questionnaire_id'=>$request->questionnaire_id,
        'phase'=>$request->phase
        ])->first();
        
        $data = [
        'user_id'=>$userQuestionnaire->user_id,
        'status'=>$request->status ?? 'pending'
        ];
        
        if($request->hasFile('file')){
        
        $path = $request->file('file')->store('vault_files','public');
        
        $data['file'] = $path;
    
        }
    
        /*
        |--------------------------------------------------------------------------
        | UPDATE OR CREATE
        |--------------------------------------------------------------------------
        */
        
        VaultPhase::updateOrCreate(
        
        [
        'questionnaire_id'=>$request->questionnaire_id,
        'phase'=>$request->phase
        ],
        
        $data
        
        );
        
        return back()->with('success','Phase updated successfully');
    
    }


    public function phaseStatus(Request $request)
    {
    
        $phase = VaultPhase::findOrFail($request->phase_id);
        
        $phase->update([
        'status'=>'active'
        ]);
        
        return back()->with('success','Phase Activated');
    
    }

    public function phaseToggle(Request $request)
    {
        
        $phase = VaultPhase::find($request->phase_id);
        
        $phase->update([
        'status'=>$request->status
        ]);
        
        return response()->json(['success'=>true]);
    
    }


}