<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Logic-Anchor | Clinical AI Governance')</title>
     <link rel="icon" type="image/png" href="{{ asset('backend/assets/favicon-96x96.png') }}" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="{{ asset('backend/assets/favicon.svg') }}" />
<link rel="shortcut icon" href="{{ asset('backend/assets/favicon.ico') }}" />
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/assets/apple-touch-icon.png') }}" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        teal: { DEFAULT: '#1a9a8a', dark: '#0e7a6e', 600: '#0d7a6e' },
                        footer: { bg: '#ddf0eb', bar: '#0d7a6e' },
                    }
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
        
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
<script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
    <style>
        @keyframes shimmer {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .shimmer-bg {
            background: linear-gradient(90deg, transparent 25%, rgba(255, 255, 255, 0.4) 50%, transparent 75%);
            background-size: 200% 100%;
            animation: shimmer 3s infinite linear;
        }

        body {
            background-color: #F8FAFC;
            color: #0F172A;
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
        }

        .vault-option {
            width: 100%;
            text-align: left;
            padding: 14px 16px;
            border-radius: 12px;
            border: 2px solid #E2E8F0;
            background: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .vault-option:hover {
            border-color: #14B8A6;
            background: #F8FAFC;
        }

        .vault-option.selected-yes {
            background: #16A34A;
            border-color: #16A34A;
            color: white;
        }

        .vault-option.selected-yes span,
        .vault-option.selected-yes i {
            color: white;
        }

        .vault-option.selected-no {
            background: #DC2626;
            border-color: #DC2626;
            color: white;
        }

        .vault-option.selected-no span,
        .vault-option.selected-no i {
            color: white;
        }

        .vault-option.selected-unknown {
            background: #F59E0B;
            border-color: #F59E0B;
            color: white;
        }

        .vault-option.selected-unknown span,
        .vault-option.selected-unknown i {
            color: white;
        }

        .hidden {
            display: none;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-vault {
            animation: fadeIn 0.4s ease-out forwards;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    <div
        class="relative min-h-screen bg-[url('https://framerusercontent.com/images/IGEMFwqsd0YwshQ0gjSPVfd9g.jpg?width=2752&height=1536')] bg-cover bg-center">
        <!-- ═══════════════════════════ HEADER ═══════════════════════════ -->
        <header class="relative min-h-[178px]">
            <div class="absolute inset-y-0 left-0 w-48"></div>
            <div class="absolute inset-y-0 right-0 w-40"></div>

            <div
                class="relative z-10 max-w-[1200px] mx-auto px-5 sm:px-8 md:px-5 flex items-center justify-between gap-4 md:gap-8">

                <!-- Logo -->
                <a href="/" class="flex flex-col items-center gap-1.5 no-underline shrink-0 p-2">
                    <img src="https://framerusercontent.com/images/vhfYgOOtbd1nPJo5HEKRoQPbSY.png" alt="Logic-Anchor"
                        class="h-24 xl:h-[240px] lg:h-[200px] md:h-[90px] sm:h-[90px] w-auto">
                </a>

                <!-- Nav -->
                <nav class="hidden lg:flex items-center gap-4">
                    <a href="/"
                        class="text-[18px] text-[#2B180A] no-underline px-6 py-2 rounded-full bg-white/50 backdrop-blur-sm hover:bg-[#007F80] hover:text-[#f5f5f5] transition-colors duration-300">Home</a>
                    <a href="/about"
                        class="text-[18px] text-[#2B180A] no-underline px-6 py-2 rounded-full bg-white/50 backdrop-blur-sm hover:bg-[#007F80] hover:text-[#f5f5f5] transition-colors duration-300">About</a>
                    <a href="/vault"
                        class="text-[18px] text-[#2B180A] no-underline px-6 py-2 rounded-full bg-white/50 backdrop-blur-sm hover:bg-[#007F80] hover:text-[#f5f5f5] transition-colors duration-300">Vault</a>
                </nav>
                <!-- Right -->
                <div class="flex items-center gap-3 shrink-0">
                    <a href="tel:+61282037129"
                        class="hidden lg:block text-[18px] text-[#101010] no-underline px-5 py-2 border border-[#007F80]/10 bg-white rounded-full backdrop-blur-sm hover:border-[#007F80] hover:bg-[#007F80] hover:text-[#f5f5f5] transition-all duration-300 whitespace-nowrap">
                        +61 2 4353 7129
                    </a>
                    <a href="mailto:Michael@logicanchor.com.au"
                        class="hidden lg:block text-[18px] font-medium text-white bg-[#007F80] px-6 py-2 border rounded-full no-underline hover:bg-[#007F80]/90 transition-colors whitespace-nowrap">
                        Contact
                    </a>
                    <button id="menu-btn" class="lg:hidden text-lg text-[#007F80] w-10 h-10 bg-white/50">
                        <i id="menu-icon" class="fas fa-bars"></i>
                    </button>

                </div>

            </div>
            <div id="mobile-menu" class="hidden lg:hidden bg-[#f5f5f5] border-t border-slate-200 px-6 top-0 absolute left-0 w-full h-screen z-[1] pt-[140px]">
                <div class="flex flex-col px-6 py-6 gap-4">
                    <a href="/" class="text-[16px] text-[#2B180A] hover:text-[#007F80] transition">
                        Home
                    </a>
                    <a href="/about" class="text-[16px] text-[#2B180A] hover:text-[#007F80] transition">
                        About
                    </a>
                    <a href="/vault" class="text-[16px] text-[#2B180A] hover:text-[#007F80] transition">
                        Vault
                    </a>
                    <a href="tel:+5435434534" class="text-[16px] text-[#007F80] font-semibold">
                        +61 2 4535 7129
                    </a>
                    <a href="mailto:Michael@logicanchor.com.au"
                        class="bg-[#007F80] text-white px-5 py-3 rounded-lg text-center font-semibold hover:bg-[#0d7a6e] transition">
                        Contact
                    </a>

                </div>

            </div>
        </header>
        
        
        <div class="flex-1 p-4 pt-10 md:p-14 flex justify-center">
            @yield('content')
        </div>
    </div>
 <!-- ═══════════════════════════ FOOTER ═══════════════════════════ -->
    <footer class="bg-[#007F80]/10 relative overflow-hidden px-8  py-8">

        <!-- Main grid -->
        <div
            class="relative z-10 max-w-[1200px] mx-auto px-8 md:px-12 pt-14 pb-8 grid grid-cols-1 md:grid-cols-[1.8fr_0.6fr_0.6fr_1.3fr] gap-10 md:gap-12">

            <!-- Brand -->
            <div class="flex gap-3 flex-col">
                <a href="/" class="flex flex-col items-start gap-1.5 no-underline">
                    <img src="https://framerusercontent.com/images/vhfYgOOtbd1nPJo5HEKRoQPbSY.png" alt="Logic-Anchor"
                        class="w-[185px] h-auto drop-shadow-md">
                </a>
                <p class="text-[20px] leading-[1.72] text-[#2B180A] max-w-[440px]">
                    Logic-Anchor Governance provides framework validation and risk mitigation protocols.&nbsp; We
                    are not a law firm. This diagnostic is for governance purposes only and does not constitute
                    legal advice.
                </p>
            </div>

            <!-- Pages -->
            <div>
                <h4 class="text-[20px] font-semibold text-[#1a1a2e] mb-4">Pages</h4>
                <ul class="flex flex-col gap-3 list-none">
                    <li><a href="/"
                            class="text-[16px] text-[#333] no-underline hover:text-[#007F80] transition-colors">Home</a>
                    </li>
                    <li><a href="/about"
                            class="text-[16px] text-[#333] no-underline hover:text-[#007F80] transition-colors">About</a>
                    </li>
                    <li><a href="/vault"
                            class="text-[16px] text-[#333] no-underline hover:text-[#007F80] transition-colors">Vault</a>
                    </li>
                    <li><a href="/quiz"
                            class="text-[16px] text-[#333] no-underline hover:text-[#007F80] transition-colors">Quiz</a>
                    </li>
                    <!--<li><a href="/settlement"-->
                    <!--        class="text-[16px] text-[#333] no-underline hover:text-[#007F80] transition-colors">Settlement</a>-->
                    <!--</li>-->
                </ul>
            </div>

            <!-- Legal -->
            <div>
                <h4 class="text-[20px] font-semibold text-[#1a1a2e] mb-4">Legal</h4>
                <ul class="flex flex-col gap-3 list-none">
                    <li><a href="/terms"
                            class="text-[16px] text-[#333] no-underline hover:text-[#007F80] transition-colors">Terms
                            of Service</a></li>
                    <li><a href="/privacy"
                            class="text-[16px] text-[#333] no-underline hover:text-[#007F80] transition-colors">Privacy
                            Policy</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-[20px] font-semibold text-[#1a1a2e] mb-4">Contact</h4>

                <!-- Address -->
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-full bg-[#007F80] flex items-center justify-center shrink-0 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-map-pin">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                    </div>
                    <p class="text-[16px] text-[#333] leading-[1.6]">Suite 891 Ground Floor 100<br>George Street
                        Parramatta,<br>Sydney NSW 2150</p>
                </div>

                <!-- Email -->
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-full bg-[#007F80] flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="white" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" viewBox="0 0 24 24">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <polyline points="2,4 12,13 22,4" />
                        </svg>
                    </div>
                    <a href="mailto:Michael@logicanchor.com.au"
                        class="text-[16px] text-[#333] no-underline hover:text-[#007F80] transition-colors">Michael@logicanchor.com.au</a>
                </div>

                <!-- Phone -->
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-[#007F80] flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="white" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" viewBox="0 0 24 24">
                            <path
                                d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .99h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" />
                        </svg>
                    </div>
                    <a href="tel:+61282037129"
                        class="text-[16px] text-[#333] no-underline hover:text-[#007F80] transition-colors">+61 02
                        3422 7129</a>
                </div>
            </div>

        </div>
        <!-- Watermark -->
        <div
            class="text-center text-[clamp(60px,9.5vw,128px)] font-black tracking-wide text-[#007F80]/10 uppercase whitespace-nowrap pointer-events-none select-none">
            Logic-Anchor
        </div>
        <!-- Bottom bar -->
        <div class="relative z-10 bg-[#007F80] rounded-3xl text-center py-6">
            <p class="text-[16px] text-white/90 tracking-wide">
                © 2026 <strong class="font-bold text-white">Logic-Anchor Governance</strong>. All Rights Reserved.
            </p>
        </div>
    
    </footer>
    <script>
        const questions = [
            { id: 'sovereignty', title: "Does your AI provider store data on Australian-based servers?", options: ["Yes", "No", "Unknown"], logic: "Data residency is a primary requirement of the 2026 Privacy Act." },
            { id: 'consent', title: "Is explicit consent for 'AI-Assisted Recording' included in forms?", options: ["Yes", "No"], logic: "OAIC guidelines require 'Explicit and Informed' consent." },
            { id: 'audit', title: "Is there a policy for doctors to verify 100% of AI-generated notes?", options: ["Yes", "No"], logic: "AHPRA holds the clinician liable for AI errors." },
            { id: 'deletion', title: "Are original audio recordings deleted within 24 hours?", options: ["Yes", "No"], logic: "Excessive data retention increases liability risk." },
            { id: 'insurance', title: "Has your insurer confirmed coverage for AI documentation?", options: ["Yes", "No"], logic: "Unverified tools can void professional indemnity." }
        ];

        let currentStep = 0;
        let answers = {};
        let score = 0;
        let userData = {};

        // function startQuiz() {
        //     userData.client = document.getElementById('clientName').value || "CLINIC-X";
        //     userData.manager = document.getElementById('managerName').value || "AUTHORIZED-USER";
        //     userData.count = document.getElementById('clinicianCount').value || "0";
        //     userData.date = document.getElementById('clinicianDate').value;
            
        //     document.getElementById('setup-container').classList.add('hidden');
        //     document.getElementById('quiz-container').classList.remove('hidden');
        //     showQuestion();
        // }
        function startQuiz() {

    const client = document.getElementById('clientName').value.trim();
    const manager = document.getElementById('managerName').value.trim();
    const count = document.getElementById('clinicianCount').value.trim();
    const date = document.getElementById('clinicianDate').value.trim();

    const errorBox = document.getElementById('form-error');

    if(!client || !manager || !count || !date){

        errorBox.classList.remove('hidden');

        return;
    }

    errorBox.classList.add('hidden');

    userData.client = client;
    userData.manager = manager;
    userData.count = count;
    userData.date = date;

    document.getElementById('setup-container').classList.add('hidden');
    document.getElementById('quiz-container').classList.remove('hidden');

    showQuestion();
}

        function showQuestion() {
            const q = questions[currentStep];
            document.getElementById('step-count').innerText = `0${currentStep + 1}/05`;
            document.getElementById('progress-bar').style.width = `${((currentStep + 1) / questions.length) * 100}%`;
            document.getElementById('question-title').innerText = q.title;
            document.getElementById('logic-text').innerText = q.logic;
            
            const optionsBox = document.getElementById('options-container');
            optionsBox.innerHTML = '';
            
            q.options.forEach(opt => {
                const btn = document.createElement('button');
                btn.className = "vault-option";
                btn.innerHTML = `
                    <span class="text-[11px] font-black text-slate-700 uppercase tracking-wider">${opt}</span>
                    <i class="fas fa-chevron-right text-slate-200 group-hover:text-teal-500 transition-colors"></i>
                `;
                btn.onclick = () => handleAnswer(q.id, opt);
                optionsBox.appendChild(btn);
            });
        }

        function handleAnswer(id, val) {
            answers[id] = val;
            if (val === "Yes") score += 20;
            document.getElementById('status-percent').innerText = `${score}%`;

            if (currentStep < questions.length - 1) {
                currentStep++;
                showQuestion();
            } else {
                showResults();
            }
        }

        function showResults() {
            document.getElementById('quiz-container').classList.add('hidden');
            document.getElementById('results-container').classList.remove('hidden');
            
            document.getElementById('res-client-title').innerText = userData.client;
            document.getElementById('res-manager').innerText = userData.manager;
            document.getElementById('res-count').innerText = userData.count;
            document.getElementById('res-score-final').innerText = `${score}%`;
            
            
              document.getElementById('form_client').value = userData.client
        document.getElementById('form_manager').value = userData.manager
        document.getElementById('form_count').value = userData.count
        document.getElementById('form_date').value = userData.date
        document.getElementById('form_score').value = score
        document.getElementById('form_answers').value = JSON.stringify(answers)
        
        
            // document.getElementById('res-date-stamp').innerText = `NODE_STAMP: ${new Date().toLocaleDateString('en-AU').toUpperCase()} // PROTOCOL_V3`;

            const gapList = document.getElementById('gap-list');
            gapList.innerHTML = '';
            
            const gapDetails = {
                'sovereignty': 'Data residency gap detected.',
                'consent': 'Patient intake protocol deficiency.',
                'audit': 'Human-in-the-loop oversight missing.',
                'deletion': 'Data retention liability identified.',
                'insurance': 'Professional indemnity misalignment.'
            };

            let gapsFound = false;
            Object.keys(answers).forEach(key => {
                if (answers[key] !== "Yes") {
                    gapsFound = true;
                    gapList.innerHTML += `
                        <div class="p-3 bg-red-50 border border-red-100 rounded-lg flex items-center gap-3">
                            <i class="fas fa-exclamation-triangle text-red-500 text-[15px]"></i>
                            <span class="text-[15px] font-bold text-red-700 uppercase tracking-tight">${gapDetails[key]}</span>
                        </div>
                    `;
                }
            });

            if (!gapsFound) {
                gapList.innerHTML = '<div class="p-6 text-center text-[15px] text-teal-600 font-bold uppercase tracking-widest border border-dashed border-teal-200 rounded-xl bg-teal-50/50">All Protocols Secure</div>';
            }
        }

        document.getElementById('live-date').innerText = new Date().toLocaleDateString('en-AU').toUpperCase();
        
        
        function submitDiagnostic(){
            
           let email = document.getElementById('email').value.trim();

            const errorBoxEmail = document.getElementById('form-error-email');

            // Email required check
            if(email === ""){
                //alert("Email is required");
                errorBoxEmail.classList.remove('hidden');
                errorBoxEmail.innerText = "Email is required";
                return;
            }
        
            // Email format validation
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
            if(!emailPattern.test(email)){
                //alert("Please enter a valid email address");
                errorBoxEmail.classList.remove('hidden');
                errorBoxEmail.innerText = "Please enter a valid email address";
                
                return;
            }
            
            errorBoxEmail.classList.add('hidden');
        
        
        document.getElementById('form_client').value = userData.client
        document.getElementById('form_manager').value = userData.manager
        document.getElementById('form_count').value = userData.count
        document.getElementById('form_date').value = userData.date
        document.getElementById('form_score').value = score
        document.getElementById('form_answers').value = JSON.stringify(answers)
        
        document.getElementById('paymentForm').submit()
        
        }


    </script>
    
    
<script>

@if(session('success'))

iziToast.success({
title: 'Success',
message: "{{ session('success') }}",
position: 'topRight'
});

@endif


@if(session('error'))

iziToast.error({
title: 'Error',
message: "{{ session('error') }}",
position: 'topRight'
});

@endif


@if ($errors->any())

iziToast.error({
title: 'Validation Error',
message: "{{ $errors->first() }}",
position: 'topRight'
});

@endif

</script>
<script>
let selectedPlan = null

function selectPlan(plan,price){

selectedPlan = plan

document.getElementById('planInput').value = plan

document.querySelectorAll('.plan-card')
.forEach(card=>card.classList.remove('plan-selected'))

event.currentTarget.classList.add('plan-selected')

checkReady()

}

function checkReady(){

const terms = document.getElementById('terms').checked

if(selectedPlan && terms){
document.getElementById('payBtn').disabled = false
}else{
document.getElementById('payBtn').disabled = true
}

}

</script>
</body>
</html>