@extends('layouts.userfr.index')

@section('content')
    <div class="w-full max-w-5xl">
      <div class="max-w-xl w-full bg-white rounded-2xl shadow-lg p-10 mx-auto">

<div class="text-center mb-6">

<div class="w-20 h-20 mx-auto bg-red-100 rounded-full flex items-center justify-center mb-4">

<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
</svg>

</div>

<h2 class="text-2xl font-bold">
Payment Failed
</h2>

<p class="text-slate-500 mt-2">
Your payment was cancelled or could not be processed.
</p>

</div>

<div class="border-t pt-6 text-center">

<p class="text-sm text-slate-500 mb-6">
Please try again to complete your Vault Certification payment.
</p>

<div class="space-y-3">

<a href="{{ route('user.payment') }}"
class="block w-full py-3 bg-slate-900 text-white rounded-xl font-semibold">

Retry Payment

</a>

<a href="{{ url('/') }}"
class="block w-full py-3 border border-slate-300 rounded-xl font-semibold">

Return to Home

</a>

</div>

</div>

</div>   
    </div>
@endsection