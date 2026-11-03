@extends('layouts.userfr.index')

@section('content')
<div class="w-full max-w-3xl">
        <div id="setup-container" class="animate-vault">
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="font-black text-slate-800 tracking-tight text-lg uppercase">Start Risk Diagnostic</h3>
                </div>
        
                <div class="p-8 space-y-6">
        
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                     <div class="space-y-2">
                        <label class="block text-sm font-bold uppercase tracking-widest text-slate-500">
                            Practice Name
                        </label>
                        <input 
                            type="text" 
                            id="clientName" 
                            placeholder="e.g. ALPHA-CLINIC-MELB"
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm 
                            focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition" required >
                    </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-bold uppercase tracking-widest text-slate-500">
                                Practice Manager
                            </label>
                            <input 
                                type="text" 
                                id="managerName" 
                                placeholder="Authorized Officer"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm 
                                focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition" required>
                        </div>
        
                       
        
                    </div>
        
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
                        
                        <div class="space-y-2">
                            <label class="block text-sm font-bold uppercase tracking-widest text-slate-500">
                                Clinician Count
                            </label>
                            <input 
                                type="number" 
                                id="clinicianCount" 
                                placeholder="0"
                                step="1"
                                min="1"
                                value="1"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm 
                                focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition" required>
                        </div>
                         <div class="space-y-2">
                            <label class="block text-sm font-bold uppercase tracking-widest text-slate-500">
                                Date 
                            </label>
                            <input 
                                type="date" 
                                id="clinicianDate" 
                                placeholder="Enter Date"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm 
                                focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition" required>
                        </div>
        
                    </div>
                        <div id="form-error" class="hidden bg-red-100 text-red-600 text-sm p-3 rounded-lg mb-4">
                        Please fill all required fields before starting the diagnostic.
                        </div>
        
                    <button onclick="startQuiz()" 
                        class="w-full py-4 bg-slate-900 text-white text-sm font-black rounded-xl 
                        hover:bg-slate-800 transition-all uppercase tracking-[0.25em] 
                        shadow-xl shadow-slate-200 active:scale-[0.98]">
                        Start Risk Diagnostic
                    </button>
        
                </div>
            </div>
        </div>
    
    
    
        <!-- PHASE 2: QUIZ -->
        <div id="quiz-container" class="hidden animate-vault">
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        
                <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <div>
                        <p id="step-count" class="text-[15px] text-slate-400 font-mono tracking-widest uppercase">
                            01/05
                        </p>
                    </div>
        
                    <div class="text-right">
                        <div class="text-[15px] font-bold text-teal-600 uppercase tracking-widest mb-1">
                            Compliance
                        </div>
                        <div id="status-percent" class="text-xl font-black text-slate-900">0%</div>
                    </div>
                </div>
        
        
                <div class="p-8">
        
                    <div class="relative h-2 w-full bg-slate-100 rounded-full overflow-hidden border border-slate-200 mb-8">
                        <div id="progress-bar" class="h-full bg-teal-500 transition-all duration-700 w-0">
                            <div class="w-full h-full shimmer-bg opacity-30"></div>
                        </div>
                    </div>
        
                    <h3 id="question-title" class="text-lg font-bold text-slate-800 mb-6 leading-tight"></h3>
        
                    <div id="options-container" class="space-y-4">
                        <!-- Options Injected -->
                    </div>
        
                </div>
        
        
                <div class="bg-slate-50 px-8 py-4 border-t border-slate-100 flex items-start gap-3">
                    <i class="fas fa-info-circle text-slate-400 mt-1"></i>
        
                    <div>
                        <!--<p class="text-[15px] font-bold text-slate-500 uppercase tracking-widest">-->
                        <!--    Risk Logic-->
                        <!--</p>-->
        
                        <p id="logic-text" class="text-sm text-slate-500 leading-relaxed italic"></p>
                    </div>
                </div>
        
            </div>
        </div>
    
    
    
        <!-- PHASE 3: RESULTS -->
        <div id="results-container" class="hidden animate-vault">
        
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        
                <div class="p-8 bg-slate-900 text-white flex justify-between items-end">
        
                    <div>
                        <p class="text-[15px] text-teal-400 font-mono tracking-widest uppercase mb-2">
                            Practice Name
                        </p>
        
                        <h2 class="text-3xl font-black uppercase tracking-tight" id="res-client-title">
                            Practice Name
                        </h2>
        
                        <p class="text-[15px] text-slate-400 font-mono tracking-widest mt-2 uppercase" id="res-date-stamp"></p>
                    </div>
        
                    <div class="bg-teal-600 px-4 py-2 rounded-lg text-center">
                        <div id="res-score-final" class="text-2xl font-black">0%</div>
                        <div class="text-[8px] uppercase font-bold tracking-widest">Score</div>
                    </div>
        
                </div>
        
        
                <div class="p-8">
        
                    <div class="grid grid-cols-2 gap-4 mb-8">
        
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                            <span class="block text-sm font-bold uppercase tracking-widest text-slate-500">
                                Practice Manager
                            </span>
                            <p class="text-sm font-bold text-slate-800" id="res-manager">-</p>
                        </div>
        
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                            <span class="block text-sm font-bold uppercase tracking-widest text-slate-500">
                                Clinicians
                            </span>
                            <p class="text-sm font-bold text-slate-800" id="res-count">-</p>
                        </div>
        
                    </div>
        
        
                    <h4 class="text-[15px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 flex items-center">
                        Governance Gaps
                        <span class="ml-4 h-px flex-1 bg-slate-100"></span>
                    </h4>
        
                    <div id="gap-list" class="space-y-3 mb-8">
                        <!-- Gaps Injected -->
                    </div>
        
        
                  <form id="paymentForm" method="POST" action="{{route('vault.start.payment')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <input type="hidden" name="practice_name" id="form_client">
        <input type="hidden" name="manager_name" id="form_manager">
        <input type="hidden" name="clinician_count" id="form_count">
        <input type="hidden" name="date" id="form_date">
        <input type="hidden" name="score" id="form_score">
        <input type="hidden" name="answers" id="form_answers">
        
        <div class="space-y-2">
        <label class="block text-sm font-bold uppercase tracking-widest text-slate-500">
        Email
        </label>
        
        <input
        type="email"
        name="email"
        id="email"
         required
        placeholder="Enter Your Email"
        class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm
        focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none">
        </div>
        <div id="form-error-email" class="hidden bg-red-100 text-red-600 text-sm p-3 rounded-lg mb-4 mt-2">
                        Please fill all required fields before starting the diagnostic.
                        </div>
        <div class="flex gap-4 mt-4">
        
        <button type="button"
        onclick="submitDiagnostic()"
        class="flex-1 py-4 bg-teal-600 text-white text-sm font-black rounded-xl uppercase tracking-widest shadow-lg">
        
        Secure Your Anchor
        
        </button>
        
        </div>
        
        </form>
        
           <!--<div class="space-y-2">-->
           <!--                 <label class="block text-sm font-bold uppercase tracking-widest text-slate-500">-->
           <!--                     Email-->
           <!--                 </label>-->
           <!--                 <input -->
           <!--                     type="email" -->
           <!--                     id="email" -->
           <!--                     placeholder="Enter Your Email"-->
           <!--                     class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm -->
           <!--                     focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition" required>-->
           <!--             </div>-->
           <!--         <div class="flex gap-4 no-print">-->
        
           <!--             <button -->
           <!--                 class="flex-1 py-4 bg-teal-600 text-white text-sm font-black rounded-xl uppercase tracking-widest shadow-lg">-->
           <!--                 Secure Your Anchor-->
           <!--             </button>-->
        
                        <!--<button onclick="location.reload()" -->
                        <!--    class="px-6 py-4 border border-slate-200 text-slate-400 text-sm font-black rounded-xl uppercase tracking-widest hover:text-slate-800 transition-all">-->
                        <!--    Reset-->
                        <!--</button>-->
        
           <!--         </div>-->
        
                </div>
        
            </div>
        </div>
    
         
    </div>
@endsection
