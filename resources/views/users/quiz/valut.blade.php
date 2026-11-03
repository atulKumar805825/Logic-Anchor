<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinical Vault | Command Center</title>
     <link rel="icon" type="image/png" href="{{ asset('backend/assets/favicon-96x96.png') }}" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="{{ asset('backend/assets/favicon.svg') }}" />
<link rel="shortcut icon" href="{{ asset('backend/assets/favicon.ico') }}" />
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/assets/apple-touch-icon.png') }}" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        .shimmer-bg {
            background: linear-gradient(90deg, transparent 25%, rgba(255,255,255,0.4) 50%, transparent 75%);
            background-size: 200% 100%;
            animation: shimmer 3s infinite linear;
        }
        .phase-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .modal-overlay {
            background-color: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(8px);
            display: none;
            position: fixed;
            inset: 0;
            z-index: 50;
            align-items: center;
            justify-content: center;
        }
        .modal-active {
            display: flex;
        }
        
        /* Refined Form Styling */
        .clinical-form-group {
            @apply mb-5;
        }
        .clinical-input {
            @apply w-full bg-slate-50 border border-slate-200 rounded-lg p-3 text-md text-slate-700 placeholder:text-slate-300 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 focus:bg-white outline-none transition-all;
        }
        .clinical-label {
            @apply block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2;
        }
        .clinical-select {
            @apply appearance-none bg-no-repeat bg-[right_0.75rem_center] bg-[length:1em_1em] w-full bg-slate-50 border border-slate-200 rounded-lg p-3 text-md text-slate-700 outline-none transition-all focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        }
        
        /* Custom Range Slider Styling */
        input[type=range] {
            @apply h-2 w-full bg-slate-100 rounded-lg appearance-none cursor-pointer border border-slate-200;
        }
        input[type=range]::-webkit-slider-thumb {
            @apply appearance-none h-5 w-5 bg-white border-2 border-blue-600 rounded-full shadow-md;
        }
        
        .download-icon-white
        {
            background-color: white;
            padding: 3px;
            border-radius: 3px;
            font-size: 16px;
        }
        
    </style>
</head>
<body class="bg-slate-50 text-slate-900 font-sans min-h-screen p-4 md:p-8">

    <!-- Modal System -->
    <div id="form-modal" class="modal-overlay p-4">
        <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300 border border-slate-200">
            <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400">
                        <i id="modal-icon" class="fas fa-microchip"></i>
                    </div>
                    <div>
                        <h3 id="modal-title" class="font-black text-slate-800 tracking-tight text-lg">Form Title</h3>
                        <p id="modal-subtitle" class="text-[10px] text-slate-400 font-mono tracking-widest uppercase">Sub-Heading</p>
                    </div>
                </div>
                <button onclick="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-slate-200 text-slate-400 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="p-8">
                <!-- Phase 1: Audit Form Template -->
                <div id="form-template-1" class="hidden space-y-6 bg-white p-6 rounded-xl shadow-lg border border-gray-200">

    <!-- Clinical Facility ID -->
    <div class="space-y-2 mt-3">
        <label class="block text-md font-semibold text-gray-700">
            Clinical Facility ID
        </label>
        <input 
            type="text" 
            placeholder="e.g. HOSP-992-ALPHA"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                   outline-none transition">
    </div>

    <!-- Authorized Officer Credentials -->
    <div class="space-y-2 mt-3">
        <label class="block text-md font-semibold text-gray-700">
            Authorized Officer Credentials
        </label>
        <input 
            type="text" 
            placeholder="RSA Key or Auth-ID"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                   outline-none transition">
    </div>

    <!-- Last Protocol Synchronization -->
    <div class="space-y-2 mt-3">
        <label class="block text-md font-semibold text-gray-700">
            Last Protocol Synchronization
        </label>
        <input 
            type="date"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                   outline-none transition">
    </div>

    <!-- Governance Level -->
    <div class="space-y-2 mt-3">
        <label class="block text-md font-semibold text-gray-700">
            Governance Level
        </label>
        <select 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                   outline-none transition bg-white">
            <option>Level A - Federal Compliance</option>
            <option>Level B - State Standard</option>
            <option>Level C - Local Protocol</option>
        </select>
    </div>

</div>

                <!-- Phase 2: Stress Test Form Template -->
                <!-- Phase 2: Stress Test Form Template -->
<div id="form-template-2" class="hidden space-y-6 bg-white p-6 rounded-xl shadow-lg border border-gray-200">

    <!-- Simulation Pressure -->
    <div class="space-y-2 mt-3">
        <label class="block text-md font-semibold text-gray-700">
            Simulation Pressure (Liability Load)
        </label>

        <input 
            type="range" 
            min="0" 
            max="100" 
            value="50"
            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-blue-600"
        >

        <div class="flex justify-between text-xs text-gray-500">
            <span>Low</span>
            <span>Moderate</span>
            <span>Critical</span>
        </div>
    </div>

    <!-- Test Protocol Type -->
    <div class="space-y-2 mt-3">
        <label class="block text-md font-semibold text-gray-700">
            Test Protocol Type
        </label>

        <select 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                   outline-none transition bg-white"
        >
            <option>Standard Litigation</option>
            <option>Catastrophic Failure</option>
            <option>Regulatory Audit Simulation</option>
        </select>
    </div>

    <!-- Override Authorization -->
    <div class="space-y-2 mt-3">
        <label class="block text-md font-semibold text-gray-700">
            Override Authorization
        </label>

        <input 
            type="password" 
            placeholder="Security Code Required"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                   focus:ring-2 focus:ring-red-500 focus:border-red-500 
                   outline-none transition"
        >
    </div>

</div>

                <form id="active-form" onsubmit="event.preventDefault();" class="mt-4">
                    <div id="modal-fields-container">
                        <!-- Content swapped via JS -->
                    </div>
                    <div class="pt-4">
                        <button id="modal-submit" onclick="submitActiveForm()" class="w-full py-4 bg-slate-900 text-white text-xs font-black rounded-xl hover:bg-slate-800 transition-all uppercase tracking-[0.25em] shadow-xl shadow-slate-200 active:scale-[0.98]">
                            Finalize & Secure Data
                        </button>
                    </div>
                </form>
            </div>
            <div class="bg-slate-50 px-8 py-4 border-t border-slate-100 flex items-center justify-between text-[10px] text-slate-400 font-mono">
                <span><i class="fas fa-shield-alt mr-1"></i> END-TO-END ENCRYPTED</span>
                <span>VAULT_PROTO_V3</span>
            </div>
        </div>
    </div>

    <!-- Header / Brand -->
    <div class="max-w-5xl mx-auto flex justify-between items-center mb-10 border-b border-slate-200 pb-6">
        <div class="flex items-center gap-3">
            <!--<div class="bg-teal-600 p-2 rounded-lg shadow-sm">-->
            <!--    <i class="fas fa-shield-halved text-white text-xl"></i>-->
            <!--</div>-->
            <div>
                <img src="https://framerusercontent.com/images/vhfYgOOtbd1nPJo5HEKRoQPbSY.png" width="120px">
                <!--<h1 class="text-xl font-black tracking-tight uppercase text-slate-800 leading-none">Clinical Vault</h1>-->
                <!--<p class="text-[10px] text-slate-400 font-mono tracking-widest mt-1">COMMAND CENTER V3.0</p>-->
            </div>
            
            
        </div>
           
        <div id="subscription-container" class="flex items-center gap-3">

    <button id="activate-btn" 
        class="px-5 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded shadow-md text-xl font-bold transition-all uppercase">

        @if(!@$subscriptionActive)
            Subscription Not Active
        @endif

    </button>

    @if(!@$subscriptionActive)
    <div id="subscription-badge"
        class="hidden flex items-center gap-2 px-4 py-2 bg-red-50 border border-red-200 rounded-full text-red-700 text-[13px] font-bold uppercase tracking-tight">
        <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
        Subscription Not Active
    </div>
    @else
    <div id="subscription-badge"
        class="hidden flex items-center gap-2 px-4 py-2 bg-teal-50 border border-teal-200 rounded-full text-teal-700 text-[13px] font-bold uppercase tracking-tight">
        <span class="w-2 h-2 bg-teal-500 rounded-full animate-pulse"></span>
        Subscription Active
    </div>
    @endif

    <a href="{{route('logout')}}"
        class="px-5 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded shadow-md text-xs font-bold transition-all uppercase flex items-center">

        <iconify-icon icon="heroicons-outline:login"
            class="relative top-[2px] text-lg mr-1"></iconify-icon>

        <span class="font-Inter">Logout</span>
    </a>

</div>
        
    </div>

    <div class="max-w-5xl mx-auto space-y-6">
        
        <!-- 1. THE LIVE COMPLIANCE MONITOR -->
        <section class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm relative overflow-hidden">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h2 class="text-slate-400 text-[11px] font-bold uppercase tracking-[0.2em] mb-3"> Governance Engine</h2>
                    <div class="text-4xl font-light text-slate-900 tracking-tight">
                        Current Governance Status: <span id="percent-display" class="font-bold">0%</span>
                    </div>
                    <p id="status-text" class="text-teal-600 font-bold text-md mt-3 flex items-center gap-2 uppercase tracking-tighter">
                        <i class="fas fa-wave-square"></i>
                        Data Intake
                    </p>
                </div>
                <div class="text-right hidden md:block">
                    <!--<div class="px-3 py-1 bg-slate-100 rounded text-[10px] font-mono text-slate-500 mb-1">STABLE_CONNECTION</div>-->
                    <!--<p class="text-slate-400 text-[9px] font-mono uppercase">Node: DX-ALPHA-WHITE</p>-->
                </div>
            </div>

            <div class="relative h-4 w-full bg-slate-100 rounded-full overflow-hidden border border-slate-200 shadow-inner">
                <div id="progress-bar" class="h-full bg-slate-200 transition-all duration-1000 ease-in-out w-0">
                    <div class="w-full h-full shimmer-bg opacity-30"></div>
                </div>
            </div>

            <div id="lock-overlay" class="absolute inset-0 bg-white/90 locked-overlay flex flex-col items-center justify-center z-10">
                <div class="bg-slate-50 p-4 rounded-full mb-4">
                    <i class="fas fa-lock text-slate-300 text-2xl"></i>
                </div>
                <p class="text-md font-bold text-slate-400 uppercase tracking-widest">Initialization Required</p>
                <p class="text-xs text-slate-400 mt-1">Pending Subscription Validation</p>
            </div>
        </section>

        @if($subscriptionActive)
        
        <!-- 2. THE 3-PHASE EXECUTION TRACKER -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Phase 1 Card -->
            <div id="card-1" class="phase-card p-6 rounded-2xl border bg-slate-50 border-slate-100">
                <div class="flex items-center justify-between mb-4">
                    <span id="label-1" class="text-[10px] font-bold uppercase tracking-widest text-slate-400">01 // Data Intake</span>
                    <i id="icon-1" class="fas fa-circle text-[8px] text-slate-200"></i>
                </div>
                <h3 id="title-1" class="text-base font-bold mb-2 text-slate-400">Data Intake</h3>
                <!--<p id="desc-1" class="text-slate-400 text-xs mb-6 leading-relaxed">Scan existing clinical protocols against current regulatory frameworks.</p>-->
                
                <!--<div id="action-1" class="hidden">-->
                <!--    <button onclick="openForm(1)" class="w-full py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-[11px] font-bold rounded-lg transition-all uppercase tracking-wider shadow-sm">-->
                <!--        Open Audit Portal-->
                <!--    </button>-->
                <!--</div>-->
                <!--<div class=" pb-2">-->
                <!--    <button onclick="showAnswer(1)" class="w-full py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-[11px] font-bold rounded-lg transition-all uppercase tracking-wider shadow-sm">-->
                <!--        View Answer-->
                <!--    </button>-->
                <!--    Logic-Anchor-Clinical-Inventory.pdf-->
                <!--</div>-->
                
                @if(!empty($initial) && $initial?->status == 'active')
                <div class="pb-2">
                <a href="{{ asset('storage/pdf/Logic-Anchor-Clinical-Inventory.pdf') }}"
                  
                   class="block w-full py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-[11px] font-bold rounded-lg transition-all uppercase tracking-wider shadow-sm text-center pointer-events-none cursor-not-allowed" style="background-color: rgb(134 139 149) !important;border-color: rgb(134 139 149);color:#FFFFFF">
                    DOWNLOADED INVENTORY DATA SHEET
                </a>
                
                </div>
                <div class="pb-2">
                <a href="{{ asset('storage/'.$initial?->file) }}"
                    download
                   class="block w-full py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-[11px] font-bold rounded-lg transition-all uppercase tracking-wider shadow-sm text-center ">
                    <i id="icon-1" class="fas fa-download text-md text-teal-500 download-icon-white"></i> Custom Governance Handbook
                </a>
                
                </div>
                <div id="log-1" class="hidden bg-teal-50/50 border border-teal-100 rounded-lg p-3" >
                    <div class="text-[10px] font-mono text-teal-700 uppercase flex items-center justify-between mb-1">
                        <span >STATUS: ACTIVE</span>
                        <!--<span>100%</span>-->
                    </div>
                    <div class="h-1 w-full bg-teal-100 rounded-full" ><div class="h-full bg-teal-500 w-full" ></div></div>
                </div>
                @else
                
                 <div class="pb-2">
                <!--<a href="{{ asset('storage/pdf/Logic-Anchor-Clinical-Inventory.pdf') }}"-->
                <!--   download-->
                <!--   class="block w-full py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-[11px] font-bold rounded-lg transition-all uppercase tracking-wider shadow-sm text-center "-->
                <!--   style="background-color: #ff9800 !important;border-color: #ff9800;color:#FFFFFF">-->
                <!--    <i id="icon-1" class="fas fa-download text-md text-teal-500 download-icon-white"></i> DOWNLOAD INVENTORY DATA SHEET-->
                <!--</a>-->
                <a href="{{ route('inventory.download-data', $questionnaire->id) }}"
                   onclick="setTimeout(()=>location.reload(),400)"

                   class="block w-full py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-[11px] font-bold rounded-lg transition-all uppercase tracking-wider shadow-sm text-center"
                   style="background-color:#ff9800 !important;border-color:#ff9800;color:#FFFFFF">
                
                    <i class="fas fa-download text-md text-white"></i> DOWNLOAD INVENTORY DATA SHEET
                </a>
                </div>
                <div id="action-1" class="hidden bg-teal-50/50 border border-teal-100 rounded-lg p-3" style="background-color: rgb(134 139 149) !important;border-color: rgb(134 139 149);color:#FFFFFF">
                    <div class="text-[10px] font-mono text-teal-700 uppercase flex items-center justify-between mb-1">
                        @if($questionnaire->file_status == 0)
                            <span style="color:#FFFFFF">STATUS: AWAITING DOWNLOAD</span>
                        @elseif($questionnaire->file_status == 1)
                            <span style="color:#FFFFFF">STATUS: INVENTORY DOWNLOADED</span>
                        @endif

                        <!--<span style="color:#FFFFFF">STATUS: AWAITING DOWNLOAD</span>-->
                        <!--<span>100%</span>-->
                    </div>
                    <div class="h-1 w-full bg-teal-100 rounded-full" ><div class="h-full bg-teal-500 w-full" style="background-color: rgb(255 255 255);"></div></div>
                </div>
                @endif
                
            </div>

            <!-- Phase 2 Card -->
            <div id="card-2" class="phase-card p-6 rounded-2xl border bg-slate-50 border-slate-100 opacity-60">
                <div class="flex items-center justify-between mb-4">
                    <span id="label-2" class="text-[10px] font-bold uppercase tracking-widest text-slate-400">02 // Stress-Test</span>
                    <i id="icon-2" class="fas fa-circle text-[8px] text-slate-200"></i>
                </div>
                <h3 id="title-2" class="text-base font-bold mb-2 text-slate-400">Engine Stress-Test</h3>
                <!--<p id="desc-2" class="text-slate-400 text-xs mb-6 leading-relaxed">Simulated litigation pressure on governance logic pathways.</p>-->
                
                <!--<div id="action-2" class="hidden">-->
                <!--    <button onclick="openForm(2)" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-[11px] font-bold rounded-lg transition-all uppercase tracking-wider shadow-sm">-->
                <!--        Set Test Parameters-->
                <!--    </button>-->
                <!--</div>-->
               
                
                @if(!empty($stress) && $stress?->status == 'active')
                 <div class=" pb-2">
                     <a href="{{ asset('storage/'.$stress?->file) }}"
                    download
                   class="block w-full py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-[11px] font-bold rounded-lg transition-all uppercase tracking-wider shadow-sm text-center ">
                   <i id="icon-1" class="fas fa-download text-md text-teal-500 download-icon-white"></i> Custom SOPs
                </a>
                </div>
                 <div  class=" bg-blue-50/50 border border-teal-100 rounded-lg p-3">
                    <div class="text-[10px] font-mono text-teal-700 uppercase flex items-center justify-between mb-1">
                        <span>STATUS: ACTIVE</span>
                        <!--<span>Stress-Resilient</span>-->
                        <!--<span>Pass</span>-->
                    </div>
                    <div class="h-1 w-full bg-teal-100 rounded-full"><div class="h-full bg-teal-500 w-full"></div></div>
                </div>
                @else
                
                <div class=" pb-2">
                    <button  class="w-full py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-[11px] font-bold rounded-lg transition-all uppercase tracking-wider shadow-sm opacity-50 cursor-not-allowed">
                            LOCKED: AWAITING DATA RETURN                    
                            </button>
                </div>
                 <div  class=" bg-blue-50/50 border border-blue-100 rounded-lg p-3" style="background-color: rgb(134 139 149) !important;border-color: rgb(134 139 149);color:#FFFFFF">
                    <div class="text-[10px] font-mono text-blue-700 uppercase flex items-center justify-between mb-1">
                        <span style="color:#FFFFFF">STATUS: PENDING</span>
                        <!--<span>Stress-Resilient</span>-->
                        <!--<span>Pass</span>-->
                    </div>
                    <div class="h-1 w-full bg-blue-100 rounded-full"><div class="h-full bg-blue-500 w-full" style="background-color:#FFFFFF"></div></div>
                </div>
                
                @endif
                <!-- <div class=" pb-2">-->
                <!--    <button onclick="openAuditResultModal()" class="w-full py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-[11px] font-bold rounded-lg transition-all uppercase tracking-wider shadow-sm">-->
                <!--        View Audit Result -->
                <!--    </button>-->
                <!--</div>-->
                <!--<div id="log-2" class="hidden bg-blue-50/50 border border-blue-100 rounded-lg p-3">-->
                    <!--<div class="text-[10px] font-mono text-blue-700 uppercase flex items-center justify-between mb-1">-->
                    <!--    <span>STATUS: PENDING</span>-->
                        <!--<span>Stress-Resilient</span>-->
                        <!--<span>Pass</span>-->
                    <!--</div>-->
                    <!--<div class="h-1 w-full bg-blue-100 rounded-full"><div class="h-full bg-blue-500 w-full"></div></div>-->
                <!--</div>-->
            </div>

            <!-- Phase 3 Card -->
            <div id="card-3" class="phase-card p-6 rounded-2xl border  @if(!empty($certificate) && $certificate->status == 'active') border bg-white border-slate-200 shadow-sm @else bg-slate-50 border-slate-100 opacity-60 @endif">
                <div class="flex items-center justify-between mb-4">
                    <span id="label-3" class="text-[10px] font-bold uppercase tracking-widest  @if(!empty($certificate) && $certificate->status == 'active') text-teal-400 @else text-slate-400 @endif ">03 // Certification</span>
                    <i id="icon-3" class=" @if(!empty($certificate) && $certificate->status == 'active') fas fa-stethoscope text-sm text-teal-500 @else fas fa-circle text-[8px] text-slate-200  @endif"></i>
                    
                </div>
                <h3 id="title-3" class="text-base font-bold mb-2 text-slate-900">Final Certification</h3>
                
                @if(!empty($certificate) && $certificate->status == 'active')
                 <p class="text-slate-400 text-xs mb-6 leading-relaxed">Official legal endorsement and vault-sealed certificate issuance.</p>
                  <!--<p class="text-slate-400 text-xs mb-6 leading-relaxed">Official legal endorsement and vault-sealed certificate will be issued within 48 hours of intake completion.</p>-->
                
                <div class=" pb-2">
                     <a href="{{ asset('storage/'.$certificate?->file) }}"
                    download
                   class="block w-full py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-[11px] font-bold rounded-lg transition-all uppercase tracking-wider shadow-sm text-center ">
                   <i id="icon-1" class="fas fa-download text-md text-teal-500 download-icon-white"></i> Download Certificate
                </a>
                </div>
                
                <div   class=" bg-teal-50 border border-teal-200 rounded-lg p-3 flex items-center gap-3" >
                    <div class="bg-teal-500 rounded p-1">
                        <i class="fas fa-check text-[8px] text-white"></i>
                        </div>
                    <span class="text-[10px] font-bold text-teal-800 uppercase font-mono" >ACTIVE FINAL AUDIT</span>
                </div>
                @else
                  <p class="text-slate-400 text-xs mb-6 leading-relaxed">Official legal endorsement and vault-sealed certificate will be issued within 48 hours of intake completion.</p>
                <div   class=" bg-teal-50 border border-teal-200 rounded-lg p-3 flex items-center gap-3" style="background-color: rgb(134 139 149) !important;border-color: rgb(134 139 149);color:#FFFFFF">
                    <div class="bg-teal-500 rounded p-1">
                        <!--<i class="fas fa-check text-[8px] text-white"></i>-->
                        </div>
                    <span class="text-[10px] font-bold text-teal-800 uppercase font-mono" style="color:#FFFFFF">LOCKED: PENDING FINAL AUDIT</span>
                </div>
                @endif
                <!--<p class="text-slate-400 text-xs mb-6 leading-relaxed">Official legal endorsement and vault-sealed certificate issuance.</p>-->
                 
                <!--<div id="action-3" class="hidden">-->
                <!--    <button onclick="runPhase(3)" class="w-full py-2.5 bg-[#008080] hover:bg-teal-700 text-white text-[11px] font-bold rounded-lg transition-all uppercase tracking-wider shadow-sm">-->
                <!--        Certify Compliance-->
                <!--    </button>-->
                <!--</div>-->
                <!--<div id="log-3"  class="hidden bg-teal-50 border border-teal-200 rounded-lg p-3 flex items-center gap-3" style="background-color: rgb(134 139 149) !important;border-color: rgb(134 139 149);color:#FFFFFF">-->
                <!--    <div class="bg-teal-500 rounded p-1">-->
                        <!--<i class="fas fa-check text-[8px] text-white"></i>-->
                <!--        </div>-->
                <!--    <span class="text-[10px] font-bold text-teal-800 uppercase font-mono" style="color:#FFFFFF">LOCKED: PENDING FINAL AUDIT</span>-->
                <!--</div>-->
            </div>
        </div>
        @else
        
        <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
            <!-- Phase 1 Card -->
            <div  class="border border-white-200 rounded-2xl p-8 shadow-sm" style="background-color:#FFFFFF">
               

                <div class="text-center py-4">
                <h3 class="text-xl font-bold text-red-500 mb-2 uppercase tracking-wide">
                    Plan Expired
                </h3>
                <p class="text-base text-slate-500 mb-4">
                    Please activate your plan to access the Data.
                </p>
            
                <form action="{{ route('store.checkout') }}" method="POST">
                    @csrf
                    <input type="hidden" name="plan" value="{{$questionnaire->vaultPayment->plan}}">
                    <input type="hidden" name="type" value="plan_expired">
                     <input type="hidden" name="questionnaire_id" value="{{$questionnaire->id}}">
                    <button type="submit"
                        class="block w-full py-2.5 bg-orange-500 hover:bg-orange-600 text-white text-[11px] font-bold rounded-lg transition-all uppercase tracking-wider shadow-sm text-center">
                        Activate Your Plan
                    </button>
                </form>
                <!--<a href=""-->
                <!--   class="block w-full py-2.5 bg-orange-500 hover:bg-orange-600 text-white text-[11px] font-bold rounded-lg transition-all uppercase tracking-wider shadow-sm text-center">-->
                <!--    Activate Your Plan-->
                <!--</a>-->
            </div>
            </div>

            
        </div>
        
        @endif

        <!-- 3. SUBSCRIPTION & DATA PROTECTION -->
        <section class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm">
            <div class="flex items-center gap-4 mb-10 pb-6 border-b border-slate-100">
                <div class="p-3 bg-slate-50 rounded-xl text-slate-400">
                    <i class="fas fa-lock text-xl"></i>
                </div>
                <div>
                    <h4 class="text-slate-900 font-bold text-md">@if($phase != 0) Inventory Data Sheet Received @else Action Required: Submit Your Inventory Data Sheet @endif </h4>
                    <!--<p class="text-slate-400 text-xs italic">Audit and Stress-Test records are persistent within the vault. Only the Final Certificate is exportable.</p>-->
                </div>
            </div>

            <!--<div class="flex flex-col md:flex-row items-center justify-between p-8 bg-slate-50 rounded-2xl border border-slate-100 border-dashed">-->
            <!--    <div class="flex items-center gap-5 mb-6 md:mb-0">-->
            <!--        <div id="cert-icon-container" class="p-4 rounded-2xl shadow-sm transition-all duration-700 bg-white text-slate-200">-->
            <!--            <i class="fas fa-file-contract text-2xl"></i>-->
            <!--        </div>-->
            <!--        <div>-->
            <!--            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em] mb-1">Secure Export</p>-->
            <!--            <p id="cert-title" class="text-lg font-bold text-slate-300">Clinical Compliance Certificate</p>-->
            <!--        </div>-->
            <!--    </div>-->
                
                <!--<button id="download-btn" disabled class="flex items-center gap-3 px-8 py-4 rounded-xl font-bold transition-all bg-slate-200 text-slate-400 cursor-not-allowed">-->
                <!--    <i class="fas fa-download"></i>-->
                <!--    Download Official Cert-->
                <!--</button>-->
                <!--@if(!$subscriptionActive)-->
                <!--<a   id="download-btn"  href="" -->
                <!--   target="_blank"-->
                <!--   class="btn btn-success  flex items-center gap-3 px-8 py-4 rounded-xl font-bold transition-all bg-slate-200 text-slate-400 cursor-not-allowed">-->
                <!-- Activate Your Plan -->

                <!--</a>-->
                
                <!--@elseif(!empty($questionnaire?->certificate_data['certificate']))-->
                
                <!--<a   id="download-btn"  href="{{ asset('storage/' . $questionnaire?->certificate_data['certificate']) }}" -->
                <!--   target="_blank"-->
                <!--   class="btn btn-success  flex items-center gap-3 px-8 py-4 rounded-xl font-bold transition-all bg-slate-200 text-slate-400 cursor-not-allowed">-->
                
                <!--Download Certificate-->
                
                <!--</a>-->
                
                <!--@else-->
                
                <!--<form method="POST" action="{{ route('create-ceritificate') }}">-->
                <!--@csrf-->
                
                <!--<input type="hidden" name="page_name" value="certificate">-->
                
                <!--<button type="submit"  id="download-btn" disabled class="btn btn-success flex items-center gap-3 px-8 py-4 rounded-xl font-bold transition-all bg-slate-200 text-slate-400 cursor-not-allowed">-->
                
                <!--Download Governance Consultancy Service Agreement-->
                
                <!--</button>-->
                
                <!--</form>-->
                
                <!--@endif-->
            <!--</div>-->
            <div class="p-8  rounded-2xl border border-slate-100  @if($phase != 0) bg-slate-50 @else bg-orange-100 @endif">

    <div class="text-base text-slate-600 leading-relaxed text-center max-w-xl mx-auto">

        To initiate your custom framework, download the
        <span class="font-semibold text-slate-800">Inventory Data Sheet from Step 1</span>,
        have your Practice Manager complete it,
        and email the secure document to:

        <div class="mt-3 text-teal-700 font-semibold">
            <a href="mailto:Michael@logicanchor.com.au" class="underline">
                Michael@logicanchor.com.au
            </a>
        </div>

    </div>

</div>
        </section>

        <!-- Footer -->
        <div class="flex justify-center items-center text-[14px] text-slate-400 font-mono tracking-widest pt-6 border-t border-slate-200">
        <!--    <div class="flex gap-6">-->
        <!--        <span class="flex items-center gap-2 italic">-->
        <!--            <div class="w-1.5 h-1.5 rounded-full bg-teal-500"></div> System Status: Nominal-->
        <!--        </span>-->
        <!--        <span class="hidden sm:block uppercase">Encryption: AES_256_WHITE_PROTOCOL</span>-->
        <!--    </div>-->
        <!--    <button onclick="location.reload()" class="hover:text-slate-600 transition-colors underline decoration-slate-200 underline-offset-4">-->
        <!--        Reset Command Center-->
        <!--    </button>-->
        <!--</div>-->
© 2026 Logic-Anchor Governance. All Rights Reserved. | ABN: 99411831156
     </div>
    
    <div id="answer-modal" class="fixed inset-0 hidden items-center justify-center bg-black/50 z-50">

<div class="bg-white w-full max-w-xl rounded-xl p-6">

<div class="flex justify-between mb-4">
<h3 class="font-bold text-lg">Audit Answers</h3>

<button onclick="closeAnswerModal()">
<i class="fas fa-times"></i>
</button>
</div>

<div id="answer-list" class="space-y-3"></div>

</div>

</div>
<div id="audit-result-modal" class="fixed inset-0 hidden items-center justify-center bg-black/50 z-50">

<div class="bg-white w-full max-w-xl rounded-xl p-6 shadow-xl">

<div class="flex justify-between items-center mb-4">
    <h3 class="text-lg font-bold">Audit Result</h3>

    <button onclick="closeAuditResultModal()">
        <i class="fas fa-times"></i>
    </button>
</div>

{{-- AUDIT RESULT --}}
@if($questionnaire && $questionnaire->audit_result)
<div class="space-y-3">

@foreach($questionnaire->audit_result as $row)

@if($row['status'] == 'Risk Detected')

<div class="p-3 border-l-4 border-red-500 bg-red-50 rounded">

<h6 class="text-red-600 font-semibold mb-1">
Risk Detected: {{ $row['title'] }}
</h6>

<p class="text-slate-600 text-md">
{{ $row['description'] ?? '—' }}
</p>

</div>

@endif

@endforeach

</div>
@endif

</div>
</div>
    <script>
        let currentPhase = {{ $phase }};
        let subscriptionActive = {{ $subscriptionActive ? 'true' : 'false' }};
        let certificateExists = {{ $certificate_data_result ? 'true' : 'false' }};
        //let currentPhase = 2;
        let activeFormPhase = null;
        
        

        const complianceMap = {
            0: { percent: 0, text: 'Submit Your Inventory Data Sheet', color: 'bg-orange-500' ,t_color:'text-orange-500'},
            1: { percent: 33, text: 'Data Intake', color: 'bg-amber-500' ,t_color:'text-amber-500'},
            2: { percent: 66, text: 'Engine Stress Test', color: 'bg-blue-600' ,t_color:'text-blue-600'},
            3: { percent: 100, text: 'Certification', color: 'bg-[#008080]' ,t_color:'text-[#008080]'}
        };

        const uiMetadata = {
            1: { title: "Clinical Audit Portal", subtitle: "Standard Regulatory Scan V3.1", icon: "fa-clipboard-check" },
            2: { title: "Stress-Test Parameters", subtitle: "Logic Resilience Engine V4.0", icon: "fa-vial" }
        };

        function activateSystem() {
            document.getElementById('activate-btn').classList.add('hidden');
            document.getElementById('subscription-badge').classList.remove('hidden');
            document.getElementById('lock-overlay').classList.add('hidden');
            updateUI();
        }

        function openForm(phase) {
            activeFormPhase = phase;
            const meta = uiMetadata[phase];
            const modal = document.getElementById('form-modal');
            const container = document.getElementById('modal-fields-container');
            const template = document.getElementById(`form-template-${phase}`);
            
            // Set Header Metadata
            document.getElementById('modal-title').innerText = meta.title;
            document.getElementById('modal-subtitle').innerText = meta.subtitle;
            document.getElementById('modal-icon').className = `fas ${meta.icon}`;
            
            // Swap Form Content
            container.innerHTML = template.innerHTML;
            
            modal.classList.add('modal-active');
        }

        function closeModal() {
            document.getElementById('form-modal').classList.remove('modal-active');
            activeFormPhase = null;
        }

        function submitActiveForm() {
            const submitBtn = document.getElementById('modal-submit');
            submitBtn.innerHTML = `<i class="fas fa-circle-notch fa-spin mr-2"></i> ENCRYPTING DATA...`;
            submitBtn.disabled = true;

            setTimeout(() => {
                const phaseToComplete = activeFormPhase;
                closeModal();
                submitBtn.innerHTML = `Finalize & Secure Data`;
                submitBtn.disabled = false;
                
                currentPhase = phaseToComplete;
                updateUI();
            }, 1800);
        }

        function runPhase(phase) {
            const btn = document.querySelector(`#action-${phase} button`);
            btn.innerHTML = `<i class="fas fa-circle-notch fa-spin mr-2"></i> GENERATING...`;
            btn.disabled = true;

            setTimeout(() => {
                currentPhase = phase;
                updateUI();
            }, 1200);
        }

        function updateUI() {
            const status = complianceMap[currentPhase];
            const bar = document.getElementById('progress-bar');
            const display = document.getElementById('percent-display');
            const statusText = document.getElementById('status-text');
            
            bar.style.width = status.percent + '%';
            bar.className = `h-full transition-all duration-1000 ease-in-out ${status.color}`;
            display.innerText = status.percent + '%';
            statusText.innerHTML = `<i class="fas fa-check-circle"></i> ${status.text}`;
           
           
            statusText.className = `${status.t_color} font-bold text-md mt-3 flex items-center gap-2 uppercase tracking-tighter`;
           

            for (let i = 1; i <= 3; i++) {
                const card = document.getElementById(`card-${i}`);
                const label = document.getElementById(`label-${i}`);
                const title = document.getElementById(`title-${i}`);
                const icon = document.getElementById(`icon-${i}`);
                const action = document.getElementById(`action-${i}`);
                const log = document.getElementById(`log-${i}`);
                const desc = document.getElementById(`desc-${i}`);

                if (currentPhase >= i) {
                    card.classList.remove('opacity-60', 'bg-slate-50', 'border-slate-100');
                    card.classList.add('bg-white', 'border-slate-200', 'shadow-sm');
                    label.className = `text-[10px] font-bold uppercase tracking-widest ${i === 2 ? 'text-blue-600' : 'text-teal-600'}`;
                    title.classList.remove('text-slate-400');
                    title.classList.add('text-slate-900');
                    icon.className = `fas ${i === 1 ? 'fa-file-medical' : i === 2 ? 'fa-shield-virus' : 'fa-stethoscope'} text-md ${i === 2 ? 'text-blue-500' : 'text-teal-500'}`;
                    
                    if (action) action.classList.add('hidden');
                    if (desc) desc.classList.add('hidden');
                    log.classList.remove('hidden');
                } else if (currentPhase === i - 1) {
                    card.classList.remove('opacity-60');
                    title.classList.remove('text-slate-400');
                    title.classList.add('text-slate-900');
                    if (action) action.classList.remove('hidden');
                    log.classList.add('hidden');
                }
            }

            if (currentPhase === 3) {
                const certIcon = document.getElementById('cert-icon-container');
                const certTitle = document.getElementById('cert-title');
                const downloadBtn = document.getElementById('download-btn');

                certIcon.classList.remove('bg-white', 'text-slate-200');
                certIcon.classList.add('bg-teal-600', 'text-white', 'scale-110');
                certTitle.classList.remove('text-slate-300');
                certTitle.classList.add('text-slate-900');
                
                downloadBtn.disabled = false;
                downloadBtn.classList.remove('bg-slate-200', 'text-slate-400', 'cursor-not-allowed');
                downloadBtn.classList.add('bg-slate-900', 'text-white', 'hover:bg-slate-800', 'shadow-xl', 'shadow-slate-200');
                
                downloadBtn.onclick = () => {
                    const notify = document.createElement('div');
                    notify.className = "fixed bottom-10 right-10 bg-slate-900 text-white px-6 py-4 rounded-xl shadow-2xl border border-teal-500 animate-bounce text-md font-bold flex items-center gap-3 z-[100]";
                    notify.innerHTML = `<i class="fas fa-file-pdf text-teal-400"></i> Vault: Generating Encrypted Certificate...`;
                    document.body.appendChild(notify);
                    setTimeout(() => notify.remove(), 3000);
                };
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function(){

    
        activateSystem();
    
    
    // if(currentPhase == 3){
    //     runPhase(3);
    // }
    // runPhase(3);

});


let questions = @json($questions);

let answers = @json($questionnaire->answers ?? []);

function showAnswer(){

    const modal = document.getElementById('answer-modal');
    const container = document.getElementById('answer-list');

    container.innerHTML = '';

    Object.keys(questions).forEach(key => {

        let answer = answers[key] ?? "Not answered";

        container.innerHTML += `
        <div class="border rounded-lg p-3">
            <div class="font-semibold text-md">${questions[key]}</div>
            <div class="text-slate-600 mt-1">
                Answer: <strong>${answer}</strong>
            </div>
        </div>
        `;

    });

    modal.classList.remove('hidden');
    modal.classList.add('flex');

}

function closeAnswerModal(){
    document.getElementById('answer-modal').classList.add('hidden');
}

function openAuditResultModal(){
    document.getElementById('audit-result-modal').classList.remove('hidden');
    document.getElementById('audit-result-modal').classList.add('flex');
}

function closeAuditResultModal(){
    document.getElementById('audit-result-modal').classList.add('hidden');
}
    </script>
</body>
</html>