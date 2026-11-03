@extends('layouts.backend.index')

@section('content')
<style>
    .btn-success {
    --tw-bg-opacity: 1;
    background-color: rgb(0, 127, 128) !important;
    --tw-text-opacity: 1;
    color: rgb(255 255 255 / var(--tw-text-opacity));
    --tw-ring-opacity: 1;
    --tw-ring-color: rgb(0, 127, 128);
}

.dattteep{
        background-color: rgb(0, 127, 128) !important;
    padding: 8px;
    --fc-button-text-color: #FFF;
    color: #FFF;
}
.dattteepred{
    background-color: red !important;
    padding: 8px;
    --fc-button-text-color: #FFF;
    color: #FFF; 
}

.phaseToggle:checked + div {
background-color: #16a34a;
}

.phaseToggle:checked + div .dot {
transform: translateX(20px);
}


</style>
<div class="mb-5 flex justify-between items-center">
    <h4 class="text-xl font-semibold">User Details</h4>
</div>

<div class="grid grid-cols-12 gap-6">

    {{-- USER DETAIL CARD --}}
    <div class="col-span-12 md:col-span-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">User Information</h4>
            </div>
            <div class="card-body grid grid-cols-2 gap-6 p-4">
                <div>
                    <p class="text-xs text-slate-500">Name</p>
                    <p class="font-medium">{{ $user->name }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Email</p>
                    <p>{{ $user->email }}</p>
                </div>
                <!--<div>-->
                <!--    <p class="text-xs text-slate-500">Phone</p>-->
                <!--    <p>{{ $user->phone ?? '—' }}</p>-->
                <!--</div>-->
               
                <div>
                    <p class="text-xs text-slate-500">Registered</p>
                    <p>{{ $user->created_at->format('d M Y') }}</p>
                </div>
                
                 <div>
                    <p class="text-xs text-slate-500">Client Name</p>
                    <p>{{ ucfirst($user->questionnaire->client_name ?? '') }}</p>
                </div>
                  <div>
                    <p class="text-xs text-slate-500">Practice Manager</p>
                    <p>{{ ucfirst($user->questionnaire->practice_manager ?? '') }}</p>
                </div>
                 <div>
                    <p class="text-xs text-slate-500">Date</p>
                    <p>{{ \Carbon\Carbon::parse($user->questionnaire->date)->format('d M Y') }}</p>                </div>
                  <div>
                    <p class="text-xs text-slate-500">No. of Clinicians</p>
                    <p>{{ ucfirst($user->questionnaire->clinicians ?? '') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- PLAN & PAYMENT CARD --}}
    {{-- PLAN & PAYMENT CARD --}}
<div class="col-span-12 md:col-span-6">
    <div class="bg-white dark:bg-slate-800 shadow rounded-lg p-6 space-y-6 border border-slate-200 dark:border-slate-700">
        <h4 class="text-lg font-semibold text-slate-700 dark:text-slate-200">Plan & Payment</h4>

        @if($user->questionnaire && $user->questionnaire->vaultPayment)
            @php $payment = $user->questionnaire->vaultPayment; @endphp

            {{-- Plan --}}
            <div class="flex justify-between items-center bg-slate-50 dark:bg-slate-900 p-3 rounded-md">
                <span class="text-sm text-slate-500">Plan</span>
                <span class="font-medium text-slate-800 dark:text-slate-200">{{ $payment->plan ?? '—' }}</span>
            </div>

            {{-- Amount --}}
            <div class="flex justify-between items-center bg-slate-50 dark:bg-slate-900 p-3 rounded-md">
                <span class="text-sm text-slate-500">Amount</span>
                <span class="font-medium text-slate-800 dark:text-slate-200">${{ number_format($payment->amount,2) }}</span>
            </div>

            {{-- Payment Status --}}
            <div class="flex justify-between items-center bg-slate-50 dark:bg-slate-900 p-3 rounded-md">
                <span class="text-sm text-slate-500">Payment Status</span>
                <span class="inline-block px-3 py-1 text-sm font-semibold 
                    {{ $payment->payment_status == 'paid' ? 'text-green-800 bg-green-100' : 'text-yellow-800 bg-yellow-100' }} 
                    rounded-full">
                    {{ ucfirst($payment->payment_status) }}
                </span>
            </div>

            {{-- Current Status --}}
            <!--<div class="flex justify-between items-center bg-slate-50 dark:bg-slate-900 p-3 rounded-md">-->
            <!--    <span class="text-sm text-slate-500">Current Status</span>-->
            <!--    <span class="inline-block px-3 py-1 text-sm font-semibold -->
            <!--        {{ $user->questionnaire->status == 'initial_audit' ? 'text-yellow-800 bg-yellow-100' : ($user->questionnaire->status=='logic_stress_test' ? 'text-blue-800 bg-blue-100' : ($user->questionnaire->status=='governance_certified' ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100')) }} -->
            <!--        rounded-full">-->
            <!--        {{ ucfirst(str_replace('_',' ',$user->questionnaire->status)) }}-->
            <!--    </span>-->
            <!--</div>-->

            {{-- Admin: Change Status Only --}}
            <!--@if(auth()->user()->role == 'admin')-->
            <!--    <form action="{{ route('admin.users.questionnaire.status', $user->questionnaire->id) }}" method="POST" class="mt-4 flex items-center gap-2">-->
            <!--        @csrf-->
            <!--        @method('PATCH')-->
            <!--        <select name="status" class="border border-slate-300 dark:border-slate-600 rounded px-3 py-2 text-sm bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200">-->
            <!--            <option value="initial_audit" {{ $user->questionnaire->status=='initial_audit'?'selected':'' }}>Initial Audit</option>-->
            <!--            <option value="logic_stress_test" {{ $user->questionnaire->status=='logic_stress_test'?'selected':'' }}>Stress Test</option>-->
            <!--            <option value="governance_certified" {{ $user->questionnaire->status=='governance_certified'?'selected':'' }}>Certified</option>-->
                        <!--<option value="rejected" {{ $user->questionnaire->status=='rejected'?'selected':'' }}>Rejected</option>-->
            <!--        </select>-->
            <!--        <button class="bg-slate-800 dark:bg-slate-600 hover:bg-slate-900 dark:hover:bg-slate-500 text-white px-4 py-2 rounded text-sm">Update Status</button>-->
            <!--    </form>-->
            <!--@endif-->

        @else
            
            <!--@if($user->questionnaire)-->
            <!--{{-- Current Status --}}-->
            <!--<div class="flex justify-between items-center bg-slate-50 dark:bg-slate-900 p-3 rounded-md">-->
            <!--    <span class="text-sm text-slate-500">Current Status</span>-->
            <!--    <span class="inline-block px-3 py-1 text-sm font-semibold -->
            <!--        {{ $user->questionnaire->status == 'initial_audit' ? 'text-yellow-800 bg-yellow-100' : ($user->questionnaire->status=='logic_stress_test' ? 'text-blue-800 bg-blue-100' : ($user->questionnaire->status=='governance_certified' ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100')) }} -->
            <!--        rounded-full">-->
            <!--        {{ ucfirst(str_replace('_',' ',$user->questionnaire->status)) }}-->
            <!--    </span>-->
            <!--</div>-->

            <!--{{-- Admin: Change Status Only --}}-->
            <!--@if(auth()->user()->role == 'admin')-->
            <!--    <form action="{{ route('admin.users.questionnaire.status', $user->questionnaire->id) }}" method="POST" class="mt-4 flex items-center gap-2">-->
            <!--        @csrf-->
            <!--        @method('PATCH')-->
            <!--        <select name="status" class="border border-slate-300 dark:border-slate-600 rounded px-3 py-2 text-sm bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200">-->
            <!--            <option value="initial_audit" {{ $user->questionnaire->status=='initial_audit'?'selected':'' }}>Initial Audit</option>-->
            <!--            <option value="logic_stress_test" {{ $user->questionnaire->status=='logic_stress_test'?'selected':'' }}>Stress Test</option>-->
            <!--            <option value="governance_certified" {{ $user->questionnaire->status=='governance_certified'?'selected':'' }}>Certified</option>-->
                        <!--<option value="rejected" {{ $user->questionnaire->status=='rejected'?'selected':'' }}>Rejected</option>-->
            <!--        </select>-->
            <!--        <button class="bg-slate-800 dark:bg-slate-600 hover:bg-slate-900 dark:hover:bg-slate-500 text-white px-4 py-2 rounded text-sm">Update Status</button>-->
            <!--    </form>-->
            <!--@endif-->
            <!--<p class="text-slate-400">No Vault Payment record found.</p>-->
            <!--@endif-->
        @endif
    </div>
</div>

</div>

<?php /**
@php
$phases = [
'initial_audit' => 'Initial Audit',
'stress_test' => 'Stress Test',
'certificate' => 'Governance Certificate'
];
@endphp

<div class="card mt-4">
<div class="card-header">
<h4 class="card-title">Phase Documents</h4>
</div>

<div class="card-body space-y-4 p-4">

@foreach($phases as $key => $title)

@php
$phase = $user->questionnaire->phases->where('phase',$key)->first();
@endphp

<div class="flex items-center justify-between border rounded-lg p-4 bg-slate-50">

{{-- LEFT SIDE --}}
<div>

<h5 class="text-lg font-semibold">{{ $title }}</h5>

@if($phase && $phase->file)

<a href="{{ asset('storage/'.$phase->file) }}"
target="_blank"
class="text-blue-600 text-sm underline">
View File
</a>

@endif

</div>


{{-- RIGHT SIDE --}}
<div class="flex items-center gap-6">


{{-- FILE UPLOAD --}}
<form method="POST"
action="{{ route('admin.phase.upload') }}"
enctype="multipart/form-data"
class="flex items-center gap-2">

@csrf

<input type="hidden" name="phase" value="{{ $key }}">
<input type="hidden" name="questionnaire_id" value="{{ $user->questionnaire->id }}">

<input type="file" name="file" required class="text-sm">

<button class="bg-slate-800 text-white px-3 py-1 rounded text-xs">
Upload
</button>

</form>


@if(!empty($phase->file))

<label class="flex items-center cursor-pointer phase-row">

<input
type="checkbox"
class="phaseToggle hidden"
data-id="{{ $phase->id }}"
{{ $phase->status == 'active' ? 'checked' : '' }}
>

<div class="toggle-bg w-10 h-5 bg-gray-300 rounded-full shadow-inner relative transition">

<div class="dot absolute w-4 h-4 bg-white rounded-full shadow top-0.5 left-0.5 transition"></div>

</div>

<span class="ml-2 text-sm phase-status
{{ $phase->status == 'active' ? 'text-green-600' : 'text-yellow-600' }}">
{{ $phase->status == 'active' ? 'Active' : 'Pending' }}
</span>

</label>

@endif

</div>

</div>

@endforeach

</div>
</div>

**/ ?>


{{-- QUESTIONNAIRE CARD --}}
<div class="grid grid-cols-12 gap-6 mt-6">
<div class="col-span-12">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Questionnaire Answers</h4>
    </div>
    <div class="card-body space-y-6 p-4">

        @php
            $questions = [
               "sovereignty" => "Do you currently use any AI tools in your clinical workflow?",
               "consent" => "Do you store patient data on AI provider servers?",
               "audit" => "Do you perform manual review of AI outputs?",
               "deletion" => "Is patient consent obtained for AI usage?",
               "insurance" => "Do you monitor AI model performance regularly?"
            ];
        @endphp

        @if($user->questionnaire && $user->questionnaire->answers)
            @foreach($user->questionnaire->answers as $question => $answer)
                <div class="border rounded-lg p-4 bg-slate-50 dark:bg-slate-900">
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">
                       {{ $questions[$question] ?? $question }}
                    </p>
                    <p class="mt-2 text-slate-600 dark:text-slate-400">
                        {{ $answer ?? '—' }}
                    </p>
                </div>
            @endforeach
        @else
            <p class="text-slate-400">No questionnaire submitted</p>
        @endif

        {{-- AUDIT RESULT --}}
        @if($user->questionnaire && $user->questionnaire->audit_result)
            <div class="mt-6">
                <h5 class="font-semibold mb-2">Audit Result</h5>
                <div class="p-4 border rounded-lg bg-slate-50 dark:bg-slate-900 space-y-3">
                    @foreach($user->questionnaire->audit_result as $row)
                        @if($row['status'] == 'Risk Detected')
                        <div class="p-3 border-l-4 border-red-500">
                            <h6 class="text-red-500 font-semibold mb-1">
                                Risk Detected: {{ $row['title'] }}
                            </h6>
                            <p class="text-slate-600">{{ $row['description'] ?? '—' }}</p>
                        </div>
                        @else
                        <!--<div class="p-3 border-l-4 border-green-500">-->
                        <!--    <h6 class="text-green-600 font-semibold mb-1">-->
                        <!--        Compliant: {{ $row['title'] }}-->
                        <!--    </h6>-->
                        <!--    <p class="text-slate-600">{{ $row['description'] ?? '—' }}</p>-->
                        <!--</div>-->
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        

    </div>
</div>
</div>
</div>

{{-- PAYMENT HISTORY --}}
<div class="grid grid-cols-12 gap-6 mt-6">
<div class="col-span-12">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Payment History</h4>
        @if($user->questionnaire && $user->questionnaire->vaultPayments->count())

       @php
$lastPayment = $user->questionnaire->vaultPayments->sortByDesc('billing_end')->first();
$days = null;

if($lastPayment && $lastPayment->billing_end){
    $days = (int) now()->diffInDays(\Carbon\Carbon::parse($lastPayment->billing_end), false);
}
@endphp

@if($days !== null)

<div class="mb-4">

    @if($days >= 0)
        <span class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full dattteep">
            Active ({{ $days }} days remaining)
        </span>
      

    @else
        <span class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full dattteepred">
            Expired {{ abs($days) }} days ago
        </span>
    @endif

</div>

@endif

        
        </div>

    </div>
    <div class="card-body space-y-6 p-4">

       

<div class="mt-6">
    <!--<h4 class="text-lg font-semibold text-slate-700 mb-4">Payment History</h4>-->

    <div class="overflow-x-auto bg-white border border-slate-200 rounded-xl shadow-sm">

        <table class="min-w-full text-sm">

            <thead class="bg-slate-50 text-slate-600 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-5 py-3 text-left">Date</th>
                    <th class="px-5 py-3 text-left">Plan</th>
                    <th class="px-5 py-3 text-left">Amount</th>
                    <th class="px-5 py-3 text-left">Payment Method</th>
                    <th class="px-5 py-3 text-left">Status</th>
                    <th class="px-5 py-3 text-left">Transaction ID</th>
                    <th class="px-5 py-3 text-left">Start Date</th>
                    <th class="px-5 py-3 text-left">Expiry Date</th>
                    
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-200">

                @foreach($user->questionnaire->vaultPayments as $payment)

                <tr class="hover:bg-slate-50 transition">

                    <td class="px-5 py-3 text-slate-700">
                        {{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('d M Y') : '—' }}
                    </td>

                    <td class="px-5 py-3 font-medium text-slate-800 capitalize">
                        {{ $payment->plan }}
                    </td>

                    <td class="px-5 py-3 text-slate-700">
                        ${{ number_format($payment->amount,2) }}
                    </td>

                    <td class="px-5 py-3 text-slate-600 capitalize">
                        {{ $payment->payment_method }}
                    </td>

                    <td class="px-5 py-3">

                        @if($payment->payment_status == 'paid')
                            <span class="px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                Paid
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full">
                                Pending
                            </span>
                        @endif

                    </td>

                    <td class="px-5 py-3 text-xs text-slate-500">
                        {{ $payment->transaction_id ?? '—' }}
                    </td>
                    <td class="px-5 py-3">{{$payment->billing_start}}</td>
                    <td class="px-5 py-3">{{$payment->billing_end}}</td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>
</div>

@endif

    </div>
</div>
</div>
</div>


@endsection