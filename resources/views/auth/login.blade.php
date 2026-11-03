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
                    <i class="fa fa-sign-in"></i>
                
                </div>
    
                <h2 class="text-2xl font-bold">
                Sign in
                </h2>
                
                <p class="text-slate-500 mt-2">
                Sign in to your account to start using Logic Anchor Goverance
                </p>
    
            </div>  
            <div class="border-t pt-6">
    
                
                
                <form method="POST" action="{{ route('login.post') }}">
                @csrf
                
                   
                    <div class="mb-4">
                    
                    <label class="text-sm font-semibold block mb-1">
                    Email
                    </label>
                    
                    <input
                    type="email"
                    value="{{ old('email') }}"
                    
                   name="email"
                     placeholder="Enter your email"
                     required
                    class="w-full px-4 py-3 border rounded-lg ">
                    
                  

                        @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    
                    </div>
                
                    <div class="mb-4">
                    
                        <label class="text-sm font-semibold block mb-1">
                        Password
                        </label>
                        
                        <input
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                        class="w-full px-4 py-3 border rounded-lg">
                 
                        @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
            
                    
        <div class="flex justify-between">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="remember" />

                        <span class="text-slate-500 text-sm leading-6 capitalize ml-2"> Keep me signed in </span>
                    </label>

                    <a
                        class="text-sm text-slate-800 dark:text-slate-400 font-medium"
                        href="{{ route('forgot.password') }}"
                    >
                        Forgot Password?
                    </a>
                </div>
                    <button
                    class="w-full py-3 bg-slate-900 text-white rounded-xl font-semibold mt-2">
                    Sign In
                    </button>
                
                </form>
    
            </div>
    
        </div>

         
    </div>

@endsection
