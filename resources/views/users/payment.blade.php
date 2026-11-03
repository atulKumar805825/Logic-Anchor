@extends('layouts.user.index')

@section('content')
<style>
    
    .bg-primary-500 {
        background-color: rgb(0, 127, 128);
    }
    .border-primary-500
    {
        color:rgb(0, 127, 128);;
    }
    .border-primary-500 {
   
    border-color: color:rgb(0, 127, 128);
}
.border-primary-500 {
    --tw-border-opacity: 1;
    border-color:rgb(0, 127, 128);
}

.btn-primary {
    --tw-bg-opacity: 1;
    background-color:rgb(0, 127, 128);
    --tw-text-opacity: 1;
    color: rgb(255 255 255 / var(--tw-text-opacity));
    --tw-ring-opacity: 1;
    --tw-ring-color: rgb(0, 127, 128);
}
</style>
<div class="mb-5 flex justify-between items-center">
    <div>
        <h4 class="text-xl font-semibold">Vault Certification Payment</h4>
        <p class="text-sm text-slate-500 mt-1">
            Complete payment to unlock Governance Certified status
        </p>
    </div>

    <a href="{{ route('customer.dashboard') }}" class="btn btn-outline-secondary">
        Back
    </a>
</div>

<div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg overflow-hidden">
    <div class="px-6 py-4 border-b dark:border-slate-700">
        <h2 class="text-xl font-semibold">Choose Your Practice Plan</h2>
        <p class="text-sm text-slate-500">
            Select a pricing tier based on the number of doctors in your clinic
        </p>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-12 gap-6">

            {{-- CARD 1 --}}
            <div class="col-span-12 md:col-span-6 xl:col-span-4">
                <div class="card h-full border border-slate-200 dark:border-slate-700 shadow-sm">
                    <div class="card-body p-6 flex flex-col h-full">
                        <div class="mb-4">
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-success-100 text-success-700">
                                Small Practice
                            </span>
                        </div>

                        <h3 class="text-xl font-semibold mb-1">1–3 Doctors</h3>
                        <p class="text-slate-500 text-sm mb-4">
                            Rapid setup of core compliance and governance documents.
                        </p>

                        <div class="mb-5">
                            <p class="text-sm text-slate-500">Implementation Fee</p>
                            <h2 class="text-3xl font-bold">$950</h2>
                            <p class="text-sm text-slate-500 mt-1">+ $99 / month shield</p>
                        </div>

                        <div class="border-t border-slate-200 dark:border-slate-700 pt-4 mb-6">
                            <ul class="space-y-3 text-sm text-slate-600 dark:text-slate-300">
                                <li>Initial governance activation</li>
                                <li>Vault access keys issued</li>
                                <li>Core compliance setup</li>
                                <li>Transparency portal activation</li>
                            </ul>
                        </div>

                        <form method="POST" action="{{ route('vault.payment.submit') }}" class="mt-auto">
                            @csrf
                            <input type="hidden" name="plan" value="small">
                            <button type="submit" class="btn btn-dark w-full">
                                Pay for Small Practice
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- CARD 2 --}}
            <div class="col-span-12 md:col-span-6 xl:col-span-4">
                <div class="card h-full border-2 border-primary-500 shadow-md relative overflow-hidden">
                    <div class="absolute top-0 right-0 bg-primary-500 text-white text-xs px-3 py-1 rounded-bl-lg">
                        Recommended
                    </div>

                    <div class="card-body p-6 flex flex-col h-full">
                        <div class="mb-4">
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-700">
                                Medium Clinic
                            </span>
                        </div>

                        <h3 class="text-xl font-semibold mb-1">4–10 Doctors</h3>
                        <p class="text-slate-500 text-sm mb-4">
                            Best for multi-doctor operations with staff SOP and audit logs.
                        </p>

                        <div class="mb-5">
                            <p class="text-sm text-slate-500">Implementation Fee</p>
                            <h2 class="text-3xl font-bold">$1,950</h2>
                            <p class="text-sm text-slate-500 mt-1">+ $199 / month shield</p>
                        </div>

                        <div class="border-t border-slate-200 dark:border-slate-700 pt-4 mb-6">
                            <ul class="space-y-3 text-sm text-slate-600 dark:text-slate-300">
                                <li>Everything in Small Practice</li>
                                <li>Staff SOP implementation</li>
                                <li>Multi-doctor audit logs</li>
                                <li>Expanded governance workflow</li>
                            </ul>
                        </div>

                        <form method="POST" action="{{ route('vault.payment.submit') }}" class="mt-auto">
                            @csrf
                            <input type="hidden" name="plan" value="medium">
                            <button type="submit" class="btn btn-primary w-full">
                                Pay for Medium Clinic
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- CARD 3 --}}
            <div class="col-span-12 md:col-span-6 xl:col-span-4">
                <div class="card h-full border border-slate-200 dark:border-slate-700 shadow-sm">
                    <div class="card-body p-6 flex flex-col h-full">
                        <div class="mb-4">
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-warning-100 text-warning-700">
                                Large Enterprise
                            </span>
                        </div>

                        <h3 class="text-xl font-semibold mb-1">11+ Doctors</h3>
                        <p class="text-slate-500 text-sm mb-4">
                            For high-liability departments and board-level reporting requirements.
                        </p>

                        <div class="mb-5">
                            <p class="text-sm text-slate-500">Implementation Fee</p>
                            <h2 class="text-3xl font-bold">From $3,500</h2>
                            <p class="text-sm text-slate-500 mt-1">+ $399 / month shield</p>
                        </div>

                        <div class="border-t border-slate-200 dark:border-slate-700 pt-4 mb-6">
                            <ul class="space-y-3 text-sm text-slate-600 dark:text-slate-300">
                                <li>Enterprise governance setup</li>
                                <li>Department-level structures</li>
                                <li>Board-level reporting support</li>
                                <li>Custom implementation scope</li>
                            </ul>
                        </div>

                        <form method="POST" action="{{ route('vault.payment.submit') }}" class="mt-auto">
                            @csrf
                            <input type="hidden" name="plan" value="enterprise">
                            <button type="submit" class="btn btn-dark w-full">
                                Submit Enterprise Payment
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        {{-- Bottom info --}}
        <div class="card mt-8">
            <div class="card-body p-6">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 lg:col-span-4">
                        <p class="text-xs uppercase tracking-wide text-slate-500 mb-2">Payment Method</p>
                        <div class="bg-slate-50 dark:bg-slate-900 rounded-xl p-4">
                            Direct Bank Transfer (AUD)
                        </div>
                    </div>

                    <div class="col-span-12 lg:col-span-4">
                        <p class="text-xs uppercase tracking-wide text-slate-500 mb-2">Vault Activation</p>
                        <div class="bg-slate-50 dark:bg-slate-900 rounded-xl p-4">
                            Access keys issued after implementation fee verification
                        </div>
                    </div>

                    <div class="col-span-12 lg:col-span-4">
                        <p class="text-xs uppercase tracking-wide text-slate-500 mb-2">Monthly Shield</p>
                        <div class="bg-slate-50 dark:bg-slate-900 rounded-xl p-4">
                            Keeps portal status and certificate validity active
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection