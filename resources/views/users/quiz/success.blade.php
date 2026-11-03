
@extends('layouts.userfr.index')

@section('content')
   
    <div class="w-full max-w-5xl">
        <div class="max-w-xl w-full bg-white rounded-2xl shadow-lg p-10 " style="margin:auto">

            <div class="text-center mb-6">
    
                <div class="w-20 h-20 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-4">
                
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                    </svg>
                
                </div>
    
                <h2 class="text-2xl font-bold">
                Payment Successful
                </h2>
                
                <p class="text-slate-500 mt-2">
                Your Vault Certification payment has been completed.
                </p>
    
            </div>
    
            <div class="border-t pt-6">
    
                <h3 class="text-lg font-semibold mb-3">
                Create Your Account
                </h3>
                
                <p class="text-sm text-slate-500 mb-6">
                To access your governance vault and certification dashboard,
                please create your account password.
                </p>
                
                <form method="POST" action="{{route('vault.create.account')}}">
                @csrf
                
                    <input type="hidden" name="email" value="{{ session('vault.email') }}">
                
                    <div class="mb-4">
                    
                    <label class="text-sm font-semibold block mb-1">
                    Email
                    </label>
                    
                    <input
                    type="email"
                    value="{{ session('vault.email') }}"
                    readonly
                    class="w-full px-4 py-3 border rounded-lg bg-gray-100">
                    
                    </div>
                
                    <div class="mb-4">
                    
                    <label class="text-sm font-semibold block mb-1">
                    Password
                    </label>
                    
                    <input
                    type="password"
                    name="password"
                    required
                    class="w-full px-4 py-3 border rounded-lg">
            
                    </div>
            
                    <div class="mb-6">
                    
                    <label class="text-sm font-semibold block mb-1">
                    Confirm Password
                    </label>
                    
                    <input
                    type="password"
                    name="password_confirmation"
                    required
                    class="w-full px-4 py-3 border rounded-lg">
                    
                    </div>
        
                    <button
                    class="w-full py-3 bg-slate-900 text-white rounded-xl font-semibold">
                    
                    Create Account
                    
                    </button>
                
                </form>
    
            </div>
    
        </div>

         
    </div>
@endsection