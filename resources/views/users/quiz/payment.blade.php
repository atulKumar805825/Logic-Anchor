@extends('layouts.userfr.index')

@section('content')
    <style>

.plan-card{
border:2px solid #e2e8f0;
border-radius:16px;
padding:28px;
cursor:pointer;
transition:all .2s;
}

.plan-card:hover{
border-color:#0f766e;
transform:translateY(-3px);
}

.plan-selected{
border-color:#0f766e;
background:#f0fdfa;
}

</style>
    <div class="w-full max-w-5xl">
        <div class="max-w-5xl w-full bg-white rounded-2xl shadow-lg p-8">

<h2 class="text-2xl font-bold mb-2">Core Pricing Logic</h2>

<p class="text-slate-500 mb-8">The structural framework that governs how value is calculated and sustained.
Choose your practice plan</p>


<div class="grid md:grid-cols-3 gap-6">

<!-- SMALL -->
<div class="plan-card" onclick="selectPlan('small',950)">
<h3 class="font-bold text-lg mb-2">Solo Practitioner</h3>

<!--<p class="text-slate-500 text-sm mb-4">-->
<!--Small Practice-->
<!--</p>-->

<p class="text-3xl font-bold">$950</p>

<p class="text-sm text-slate-400 mb-4">
Implementation Fee + $99/month

</p>

<ul class="text-sm space-y-2 text-slate-600">
    <li class="flex items-center gap-2">
        <i class="fa fa-check text-green-500"></i>
        Full 5-Step Anchor Governance System
    </li>

    <li class="flex items-center gap-2">
        <i class="fa fa-check text-green-500"></i>
        Diagnostic Risk Audit & Liability Mapping
    </li>

    <li class="flex items-center gap-2">
        <i class="fa fa-check text-green-500"></i>
        Customized Clinical AI Handbook (Internal Law)
    </li>

    <li class="flex items-center gap-2">
        <i class="fa fa-check text-green-500"></i>
        Staff SOP Training & Data Purge Protocols
    </li>

    <li class="flex items-center gap-2">
        <i class="fa fa-check text-green-500"></i>
        Continuous Regulatory Monitoring
    </li>

    <li class="flex items-center gap-2">
        <i class="fa fa-check text-green-500"></i>
        Official Logic-Anchor Certification & Auditing
    </li>
</ul>

</div>


<!-- MEDIUM -->
<div class="plan-card" onclick="selectPlan('medium',1950)">
<h3 class="font-bold text-lg mb-2">2–5 Doctors</h3>

<!--<p class="text-slate-500 text-sm mb-4">-->
<!--Medium Clinic-->
<!--</p>-->

<p class="text-3xl font-bold">$1,950</p>

<p class="text-sm text-slate-400 mb-4">
Implementation Fee + $199/month
</p>

<ul class="text-sm space-y-2 text-slate-600">
    <li class="flex items-center gap-2">
        <i class="fa fa-check text-green-500"></i>
        Full 5-Step Anchor Governance System
    </li>

    <li class="flex items-center gap-2">
        <i class="fa fa-check text-green-500"></i>
        Diagnostic Risk Audit & Liability Mapping
    </li>

    <li class="flex items-center gap-2">
        <i class="fa fa-check text-green-500"></i>
        Customized Clinical AI Handbook (Internal Law)
    </li>

    <li class="flex items-center gap-2">
        <i class="fa fa-check text-green-500"></i>
        Staff SOP Training & Data Purge Protocols
    </li>

    <li class="flex items-center gap-2">
        <i class="fa fa-check text-green-500"></i>
        Continuous Regulatory Monitoring
    </li>

    <li class="flex items-center gap-2">
        <i class="fa fa-check text-green-500"></i>
        Official Logic-Anchor Certification & Auditing
    </li>
</ul>

</div>


<!-- ENTERPRISE -->
<div class="plan-card" onclick="selectPlan('enterprise',3500)">
<h3 class="font-bold text-lg mb-2">6+ Doctors</h3>

<!--<p class="text-slate-500 text-sm mb-4">-->
<!--Custom Quote-->
<!--</p>-->


<p class="text-3xl font-bold">Custom Quote</p>

<p class="text-sm text-slate-400 mb-4">
Minimum Implementation: $3,500

Monitoring: $399+/month
</p>
<ul class="text-sm space-y-2 text-slate-600">
    <li class="flex items-center gap-2">
        <i class="fa fa-check text-green-500"></i>
        Full 5-Step Anchor Governance System
    </li>

    <li class="flex items-center gap-2">
        <i class="fa fa-check text-green-500"></i>
        Diagnostic Risk Audit & Liability Mapping
    </li>

    <li class="flex items-center gap-2">
        <i class="fa fa-check text-green-500"></i>
        Customized Clinical AI Handbook (Internal Law)
    </li>

    <li class="flex items-center gap-2">
        <i class="fa fa-check text-green-500"></i>
        Staff SOP Training & Data Purge Protocols
    </li>

    <li class="flex items-center gap-2">
        <i class="fa fa-check text-green-500"></i>
        Continuous Regulatory Monitoring
    </li>

    <li class="flex items-center gap-2">
        <i class="fa fa-check text-green-500"></i>
        Official Logic-Anchor Certification & Auditing
    </li>
</ul>

</div>

</div>


<form method="POST" action="/stripe/checkout" id="paymentForm">
    
<!-- TERMS -->
<div class="mt-8 flex items-center gap-3">

<input type="checkbox" id="terms" onclick="checkReady()" class="w-4 h-4">

<label class="text-sm text-slate-600">
I agree that Logic-Anchor Governance provides a verification framework only and final clinical responsibility remains with the clinic.
</label>

</div>


<input type="hidden" name="_token" value="{{ csrf_token() }}">

<input type="hidden" name="plan" id="planInput">



<button
type="submit"
id="payBtn"
disabled
class="mt-6 w-full py-4 bg-slate-900 text-white rounded-xl font-bold disabled:opacity-40">

Proceed to Payment

</button>

</form>


</div>

         
    </div>
@endsection