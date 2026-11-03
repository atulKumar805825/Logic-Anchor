@extends('layouts.userfr.index')

@section('title', 'Login') 
@section('content')

 <div class="w-full max-w-5xl">
        <div class="max-w-xl w-full bg-white rounded-2xl shadow-lg p-10 " style="margin:auto">

        
            <div class="text-center mb-6">
    
                <div class="w-20 h-20 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-4">
                
                    <!--<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
                    <!--<path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>-->
                    <!--</svg>-->
                    <i class="fa fa-key"></i>
                
                </div>
    
                <h2 class="text-2xl font-bold">
                Reset Password
                </h2>
                
                <p class="text-slate-500 mt-2">
               Create a new password for your account
                </p>
    
            </div>  
            <div class="border-t pt-6">
    
                
                
                <form method="POST" action="{{ route('reset.password.post') }}">
                @csrf
                
                    <input type="hidden" name="token" value="{{ $token }}" />
                    <div class="mb-4">
                    
                    <label class="text-sm font-semibold block mb-1">
                    Email
                    </label>
                    
                    <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    class="w-full px-4 py-3 border rounded-lg " required>
                    
                    </div>
                
                    <div class="mb-4">
                    
                    <label class="text-sm font-semibold block mb-1">
                    Password
                    </label>
                    
                    <input
                    type="password"
                    name="password"
                    required
                    placeholder="Enter new password"
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
                    placeholder="Confirm password"
                    class="w-full px-4 py-3 border rounded-lg">
                    
                    </div>
        
                    <button
                    class="w-full py-3 bg-slate-900 text-white rounded-xl font-semibold">
                    
                   Reset Password
                    
                    </button>
                
                </form>
                 <div class="text-center mt-6">
                <a href="{{ route('login') }}" class="text-slate-900 dark:text-white font-medium hover:underline">
                    Back to Login
                </a>
            </div>
    
            </div>
    
        </div>

         
    </div>

@endsection
