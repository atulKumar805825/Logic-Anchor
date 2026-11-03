@extends('layouts.backend.index')

@section('title', 'Dashboard')

@section('content')

<style>
#bookingTrend{
    width:100% !important;
    height:100% !important;
}

#bookingStatus{
    width:100% !important;
    height:60% !important;
}
</style>

<div>

    {{-- Header --}}
    <div class="flex justify-between flex-wrap items-center mb-6">
        <h4 class="font-medium lg:text-2xl text-xl text-slate-900">
            Dashboard
        </h4>
    </div>


    {{-- Stat Cards --}}
    <div class="grid grid-cols-12 gap-5 mb-5">

        <div class="2xl:col-span-12 lg:col-span-12 col-span-12">
            <div class="p-4 card">
                <div class="grid md:grid-cols-4 gap-4">

                    {{-- Total Users --}}
                    <div class="py-[18px] px-4 rounded-[6px] bg-[#E5F9FF]">
                        <div class="text-sm text-slate-600 mb-1">
                            Total Users
                        </div>

                        <div class="text-lg font-medium">
                            {{ $stats['total_users'] }}
                        </div>
                    </div>


                    {{-- Payment Pending --}}
                    <div class="py-[18px] px-4 rounded-[6px] bg-[#FFEDE5]">
                        <div class="text-sm text-slate-600 mb-1">
                            Payment Pending
                        </div>

                        <div class="text-lg font-medium">
                            {{ $stats['payment_pending'] }}
                        </div>
                    </div>


                    {{-- Revenue --}}
                    <div class="py-[18px] px-4 rounded-[6px] bg-[#EAE5FF]">
                        <div class="text-sm text-slate-600 mb-1">
                            Total Revenue
                        </div>

                        <div class="text-lg font-medium">
                            ${{ number_format($stats['total_revenue'],2) }}
                        </div>
                    </div>



                </div>
            </div>
        </div>

    </div>


    

</div>





@endsection