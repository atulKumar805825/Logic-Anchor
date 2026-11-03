@extends('layouts.user.index')

@section('content')
<style>
    :root{
        --clinical-teal: rgb(0, 127, 128);
        --clinical-teal-dark: rgb(0, 108, 109);
        --clinical-soft: #f4f8f8;
        --clinical-border: #d9e7e7;
        --clinical-text: #1f2937;
        --clinical-muted: #6b7280;
        --clinical-success-bg: #ecfdf5;
        --clinical-success-text: #047857;
        --clinical-danger-bg: #fef2f2;
        --clinical-danger-text: #dc2626;
    }

    .bg-success-500 {
        background-color: var(--clinical-teal);
    }

    .btn-success {
        background-color: var(--clinical-teal) !important;
        color: #fff !important;
        border-color: var(--clinical-teal) !important;
    }

    .btn-success:hover {
        background-color: var(--clinical-teal-dark) !important;
        border-color: var(--clinical-teal-dark) !important;
    }

    .bg-success-100 {
        background-color: var(--clinical-teal);
        color: #fff;
    }

    .text-success-600 {
        color: #fff;
    }

    .vault-page-title {
        color: var(--clinical-text);
        font-weight: 700;
        letter-spacing: -.02em;
    }

    .monitor-card,
    .phase-card,
    .form-card,
    .result-card,
    .certificate-card {
        border: 1px solid var(--clinical-border);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        overflow: hidden;
    }

    .monitor-header {
        background: linear-gradient(135deg, var(--clinical-teal) 0%, var(--clinical-teal-dark) 100%);
        color: #fff;
        padding: 28px;
    }

    .monitor-label {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: .12em;
        opacity: .85;
        margin-bottom: 8px;
    }

    .monitor-percent {
        font-size: 46px;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 10px;
    }

    .monitor-subtext {
        font-size: 15px;
        opacity: .92;
    }

    .monitor-body {
        background: #fff;
        padding: 24px 28px 28px;
    }

    .monitor-bar-wrap {
        height: 14px;
        background: #e5e7eb;
        border-radius: 999px;
        overflow: hidden;
        position: relative;
    }

    .monitor-bar-fill {
        height: 100%;
        background: var(--clinical-teal);
        border-radius: 999px;
        transition: width .6s ease;
    }

    .monitor-meta {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        margin-top: 12px;
        color: var(--clinical-muted);
        font-size: 13px;
    }

    .vault-note {
        margin-top: 18px;
        padding: 14px 16px;
        background: var(--clinical-soft);
        border: 1px solid var(--clinical-border);
        border-radius: 14px;
        font-size: 14px;
        color: var(--clinical-muted);
    }

    .section-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--clinical-text);
        margin-bottom: 4px;
    }

    .section-subtitle {
        color: var(--clinical-muted);
        font-size: 14px;
        margin-bottom: 0;
    }

    .phase-card .card-body {
        padding: 28px;
    }

    .phase-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    .phase-item {
        position: relative;
        background: #fff;
        border: 1px solid var(--clinical-border);
        border-radius: 18px;
        padding: 20px 18px;
        text-align: center;
        min-height: 155px;
        transition: all .25s ease;
    }

    .phase-item.active {
        border-color: rgba(0, 127, 128, .35);
        box-shadow: 0 10px 24px rgba(0, 127, 128, .08);
        background: linear-gradient(180deg, #ffffff 0%, #f7fbfb 100%);
    }

    .phase-step {
        width: 50px;
        height: 50px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 14px;
        background: #d1d5db;
        color: #374151;
    }

    .phase-item.active .phase-step {
        background: var(--clinical-teal);
        color: #fff;
    }

    .phase-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--clinical-text);
        margin-bottom: 8px;
    }

    .phase-status {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .phase-status.done {
        background: var(--clinical-success-bg);
        color: var(--clinical-success-text);
    }

    .phase-status.pending {
        background: #f3f4f6;
        color: #6b7280;
    }

    .phase-desc {
        font-size: 13px;
        color: var(--clinical-muted);
        line-height: 1.55;
    }

    .form-card .card-body,
    .result-card .card-body,
    .certificate-card .card-body {
        padding: 28px;
    }

    .card-title-main {
        font-size: 22px;
        font-weight: 700;
        color: var(--clinical-text);
        margin-bottom: 8px;
    }

    .card-title-sub {
        color: var(--clinical-muted);
        font-size: 14px;
        margin-bottom: 24px;
    }

    .question-block {
        border: 1px solid var(--clinical-border);
        border-radius: 16px;
        padding: 18px;
        background: #fff;
        margin-bottom: 16px;
    }

    .question-label {
        display: block;
        font-weight: 600;
        color: var(--clinical-text);
        margin-bottom: 12px;
    }

    .option-group label {
        margin-right: 18px;
        font-size: 14px;
        color: var(--clinical-text);
    }

    .option-group input {
        margin-right: 6px;
    }

    .info-box {
        border: 1px solid var(--clinical-border);
        border-radius: 16px;
        padding: 18px;
        background: #fafdfd;
        margin-top: 12px;
    }

    .risk-box {
        background: var(--clinical-danger-bg);
        border: 1px solid #fecaca;
        border-radius: 14px;
        padding: 16px;
    }

    .risk-title {
        color: var(--clinical-danger-text);
        font-weight: 700;
        margin-bottom: 6px;
    }

    .safe-box {
        background: var(--clinical-success-bg);
        border: 1px solid #bbf7d0;
        border-radius: 14px;
        padding: 16px;
        color: var(--clinical-success-text);
        font-weight: 600;
    }

    .cert-header {
        background: linear-gradient(135deg, var(--clinical-teal) 0%, var(--clinical-teal-dark) 100%);
        color: white;
        text-align: center;
        padding: 34px 24px;
    }

    .cert-header h2 {
        font-size: 30px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .cert-header p {
        margin: 0;
        opacity: .9;
    }

    .cert-icon-wrap {
        width: 88px;
        height: 88px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--clinical-teal);
        color: white;
        margin-bottom: 20px;
        box-shadow: 0 12px 24px rgba(0, 127, 128, .18);
    }

    .cert-description {
        max-width: 640px;
        margin: 0 auto 28px;
        color: var(--clinical-muted);
        line-height: 1.7;
    }

    .cert-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        justify-content: center;
    }

    .cert-actions form {
        margin: 0;
    }

    .clinical-mini-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #eef9f9;
        border: 1px solid var(--clinical-border);
        color: var(--clinical-teal-dark);
        border-radius: 999px;
        padding: 8px 14px;
        font-size: 13px;
        font-weight: 600;
        margin-top: 16px;
    }

    @media (max-width: 991px) {
        .phase-grid {
            grid-template-columns: 1fr;
        }

        .monitor-percent {
            font-size: 38px;
        }
    }
    
    .lock-wrapper{
position:relative;
}

.lock-overlay{
position:absolute;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(255,255,255,0.85);
display:flex;
align-items:center;
justify-content:center;
text-align:center;
border-radius:18px;
}

.lock-overlay-content{
max-width:260px;
}

.lock-blur{
filter:blur(3px);
pointer-events:none;
}
</style>

@php
    $progress = 0;

    if($status == 'initial_audit') $progress = 33;
    if($status == 'logic_stress_test') $progress = 66;
    if($status == 'governance_certified') $progress = 100;

    $certificate_data = $questionnaire->certificate_data ?? [];
    
    if($status == 'governance_certified')
    {
        $subscription_active = true;
    }
    else
    {
        $subscription_active = false;
    }
    
    
@endphp

<div class="mb-5">
    <h4 class="vault-page-title text-xl">Vault Certification</h4>
</div>

{{-- LIVE CLINICAL COMPLIANCE MONITOR --}}
<div class="card monitor-card mb-6">
    <div class="monitor-header">
        <div class="monitor-label">Clinical Command Center</div>
        <div class="monitor-percent">{{ $progress }}%</div>
        <div class="monitor-subtext">
            Current Governance Status: <strong>{{ $progress }}% Legally Compliant</strong>
        </div>
    </div>

    <div class="monitor-body">
        <div class="monitor-bar-wrap">
            <div class="monitor-bar-fill" style="width: {{ $progress }}%"></div>
        </div>

        <div class="monitor-meta">
            <span>Initial Login: 0%</span>
            <span>Audit: 33%</span>
            <span>Stress-Test: 66%</span>
            <span>Certified: 100%</span>
        </div>

        <div class="vault-note">
            🔒 Live Governance Monitor active inside the Clinical Vault. Audit history, certification state, and compliance records are tracked here.
        </div>
    </div>
</div>

{{-- 3-PHASE EXECUTION TRACKER --}}
<div class="card phase-card mb-6">
    <div class="card-body">
        <h5 class="section-title">3-Phase Execution Tracker</h5>
        <p class="section-subtitle">Live compliance logs feeding the governance monitor.</p>

        <div class="phase-grid mt-4">
            <div class="phase-item {{ in_array($status,['initial_audit','logic_stress_test','governance_certified']) ? 'active' : '' }}">
                <div class="phase-step">1</div>
                <div class="phase-title">Initial Audit</div>
                <div class="phase-status {{ in_array($status,['initial_audit','logic_stress_test','governance_certified']) ? 'done' : 'pending' }}">
                    {{ in_array($status,['initial_audit','logic_stress_test','governance_certified']) ? 'Completed' : 'Pending' }}
                </div>
                <div class="phase-desc">
                    Baseline legal and operational governance review for clinical AI use.
                </div>
            </div>

       <div class="phase-item {{ in_array($status,['logic_stress_test','governance_certified']) ? 'active' : '' }}">
                <div class="phase-step">2</div>
                <div class="phase-title">Logic Stress-Test</div>
                <div class="phase-status {{ in_array($status,['logic_stress_test','governance_certified']) ? 'done' : 'pending' }}">
                    {{ in_array($status,['logic_stress_test','governance_certified']) ? 'Completed' : 'Pending' }}
                </div>
                <div class="phase-desc">
                    Identified risks and governance logic validation recorded in the Vault.
                </div>
            </div>
            

            <!--<div class="phase-item {{ $status == 'governance_certified' ? 'active' : '' }}">-->
            <!--    <div class="phase-step">3</div>-->
            <!--    <div class="phase-title">Governance Certified</div>-->
            <!--    <div class="phase-status {{ $status == 'governance_certified' ? 'done' : 'pending' }}">-->
            <!--        {{ $status == 'governance_certified' ? 'Completed' : 'Pending' }}-->
            <!--    </div>-->
            <!--    <div class="phase-desc">-->
            <!--        Final clinical AI governance certification and verified compliance status.-->
            <!--    </div>-->
            <!--</div>-->
            
            <div class="phase-item active lock-wrapper">

    {{-- CONTENT --}}
    <div class="{{ !$subscription_active ? 'lock-blur' : '' }}">

        <div class="phase-step">3</div>

       <div class="phase-title">Governance Certified</div>

       <div class="phase-status {{ $status == 'governance_certified' ? 'done' : 'pending' }}">
                    {{ $status == 'governance_certified' ? 'Completed' : 'Pending' }}
                </div>

         <div class="phase-desc">
                    Final clinical AI governance certification and verified compliance status.
                </div>

    </div>


    {{-- LOCK OVERLAY --}}
    @if(!$subscription_active)

    <div class="lock-overlay">

        <div class="lock-overlay-content">

            <h6 class="mb-2">🔒 Locked</h6>

            <p class="text-muted mb-3">
                Activate your plan to unlock this phase.
            </p>

            <a href="{{ route('vault.payment.page') }}" class="btn btn-success btn-sm">
                Activate Plan
            </a>

        </div>

    </div>

    @endif

</div>
        </div>
    </div>
</div>

{{-- STEP 1 FORM --}}
@if($status == 'initial_audit')
<div class="card form-card">
    <div class="card-body">
        <h5 class="card-title-main">Initial Audit Questionnaire</h5>
        <p class="card-title-sub">Complete the medical-legal intake review to activate the first compliance milestone.</p>

        <form method="POST" action="{{ route('vault.initial.audit') }}">
            @csrf

            <div class="question-block">
                <label class="question-label">1. Does your AI provider store data on Australian servers?</label>
                <div class="option-group">
                    <label><input type="radio" name="q1" value="Yes"> Yes</label>
                    <label><input type="radio" name="q1" value="No"> No</label>
                    <label><input type="radio" name="q1" value="Unknown"> Unknown</label>
                </div>
            </div>

            <div class="question-block">
                <label class="question-label">2. Is explicit consent for AI-Assisted Recording included in intake forms?</label>
                <div class="option-group">
                    <label><input type="radio" name="q2" value="Yes"> Yes</label>
                    <label><input type="radio" name="q2" value="No"> No</label>
                </div>
            </div>

            <div class="question-block">
                <label class="question-label">3. Do doctors manually verify 100% of AI generated notes?</label>
                <div class="option-group">
                    <label><input type="radio" name="q3" value="Yes"> Yes</label>
                    <label><input type="radio" name="q3" value="No"> No</label>
                </div>
            </div>

            <div class="question-block">
                <label class="question-label">4. Are audio recordings deleted within 24 hours?</label>
                <div class="option-group">
                    <label><input type="radio" name="q4" value="Yes"> Yes</label>
                    <label><input type="radio" name="q4" value="No"> No</label>
                </div>
            </div>

            <div class="question-block">
                <label class="question-label">5. Has your Medical Indemnity provider confirmed AI compliance?</label>
                <div class="option-group">
                    <label><input type="radio" name="q5" value="Yes"> Yes</label>
                    <label><input type="radio" name="q5" value="No"> No</label>
                </div>
            </div>

            <div class="info-box">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">Client Name</label>
                        <input type="text" name="client_name" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">Practice Manager</label>
                        <input type="text" name="practice_manager" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">No. of Clinicians</label>
                        <input type="number" name="clinicians" class="form-control" required>
                    </div>
                </div>
            </div>

            <button class="btn btn-success px-6 py-3">
                Submit Initial Audit
            </button>
        </form>
    </div>
</div>
@endif

@if($status == 'logic_stress_test')

<div class="card result-card">
<div class="card-body">

<h4 class="card-title-main">Audit Result</h4>
<p class="card-title-sub">
Clinical governance findings recorded from the audit review.
</p>

@php
$hasRisk = false;
@endphp


@foreach($questionnaire->audit_result as $row)

@if($row['status'] == 'Risk Detected')

@php $hasRisk = true; @endphp

<div class="risk-box mb-4">

<h6 class="risk-title">
Risk Detected: {{ $row['title'] }}
</h6>


{{-- DESCRIPTION LOCK --}}
@if($subscription_active)

@if(isset($row['description']))
<p class="mb-0 text-muted">
{{ $row['description'] }}
</p>
@endif

@else

<p class="text-muted">
🔒 Detailed governance explanation locked.
Activate your plan to unlock full compliance analysis.
</p>

@endif

</div>

@endif

@endforeach


@if(!$hasRisk)

<div class="safe-box">
All governance checks passed.
</div>

@endif



{{-- LOCKED CERTIFICATION --}}
@if(!$subscription_active)

<div class="card mt-4 border-0 shadow-sm unlock-card">

<div class="card-body text-center p-5">

<div class="mb-3" style="font-size:34px;">
🔒
</div>

<h4 class="fw-bold mb-2">
Full Compliance Report Locked
</h4>

<p class="text-muted mb-4">
Activate your subscription to unlock the complete clinical governance analysis.
</p>


<div class="row justify-content-center text-start mb-4">

<div class="col-md-6">

<ul class="list-unstyled">

<li class="mb-2">✔ Detailed Risk Explanations</li>
<li class="mb-2">✔ Governance Compliance Report</li>
<li class="mb-2">✔ Logic Stress-Test Analysis</li>
<li class="mb-2">✔ Certification Eligibility</li>

</ul>

</div>

</div>


<a href="{{ route('vault.payment.page') }}" class="btn btn-success px-5 py-2">
Activate Plan
</a>

</div>

</div>

@endif



{{-- CONTINUE CERTIFICATION --}}
@if($subscription_active)

<div class="text-center mt-4">

<a href="{{ route('vault.payment.page') }}" class="btn btn-success px-5 py-3">
Continue Certification
</a>

</div>

@endif

</div>
</div>

@endif

{{-- STEP 3 MESSAGE --}}
@if($status == 'governance_certified')
<div class="card certificate-card shadow-xl border-0">
    <div class="cert-header">
        <h2>🎉 Governance Certified</h2>
        <p>Your AI system has successfully passed the Logic-Anchor governance audit</p>
    </div>

    <div class="card-body text-center py-10">
        <div class="cert-icon-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="42" height="42">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
            </svg>
        </div>

        <p class="cert-description">
            Your system is now officially certified. Access your governance documentation and certificate from the Clinical Vault below.
        </p>

        <div class="cert-actions">
            @if(!empty($certificate_data['certificate']))
                <a href="{{ asset('storage/' . $certificate_data['certificate']) }}" target="_blank"
                   class="btn btn-success px-6 py-3 text-base">
                   Download Governance Consultancy Service Agreement
                </a>
            @else
                <form method="POST" action="{{ route('create-ceritificate') }}">
                    @csrf
                    <input type="hidden" name="page_name" value="certificate">
                    <button type="submit" class="btn btn-success px-6 py-3 text-base">
                        Download Governance Consultancy Service Agreement
                    </button>
                </form>
            @endif

            @if(!empty($certificate_data['04_LA_03_ClinicalAIGovernanceandSafetyHandbook']))
                <a href="{{ asset('storage/' . $certificate_data['04_LA_03_ClinicalAIGovernanceandSafetyHandbook']) }}" target="_blank"
                   class="btn btn-success px-6 py-3 text-base">
                   Download 04-LA-03 Clinical AI Governance and Safety Handbook
                </a>
            @else
                <form method="POST" action="{{ route('create-ceritificate') }}">
                    @csrf
                    <input type="hidden" name="page_name" value="04_LA_03_ClinicalAIGovernanceandSafetyHandbook">
                    <button type="submit" class="btn btn-success px-6 py-3 text-base">
                        Download 04-LA-03 Clinical AI Governance and Safety Handbook
                    </button>
                </form>
            @endif

            @if(!empty($certificate_data['la_05_certificate_of_clinical_ai_governance']))
                <a href="{{ asset('storage/' . $certificate_data['la_05_certificate_of_clinical_ai_governance']) }}" target="_blank"
                   class="btn btn-success px-6 py-3 text-base">
                   Download Certificate Of Clinical AI Governance
                </a>
            @else
                <form method="POST" action="{{ route('create-ceritificate') }}">
                    @csrf
                    <input type="hidden" name="page_name" value="la_05_certificate_of_clinical_ai_governance">
                    <button type="submit" class="btn btn-success px-6 py-3 text-base">
                        Download Certificate Of Clinical AI Governance
                    </button>
                </form>
            @endif
        </div>

        <div class="clinical-mini-badge">
            Verified Clinical AI Governance System
        </div>
    </div>
</div>
<div class="card result-card mt-2"> <div class="card-body"> <h4 class="card-title-main">Audit Result</h4> <p class="card-title-sub">Clinical governance findings recorded from the audit review.</p> @php $hasRisk = false; @endphp @foreach($questionnaire->audit_result as $row) @if($row['status'] == 'Risk Detected') @php $hasRisk = true; @endphp <div class="risk-box mb-4"> <h6 class="risk-title"> Risk Detected: {{ $row['title'] }} </h6> @if(isset($row['description'])) <p class="mb-0 text-muted"> {{ $row['description'] }} </p> @endif </div> @endif @endforeach @if(!$hasRisk) <div class="safe-box"> All governance checks passed. Your clinic is compliant. </div> @endif <div class="text-center mt-4">  </div> </div> </div>
@endif

@endsection