@extends('layouts.userfr.index')

@section('title', 'Forgot Password')
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
                Forgot Your Password?
                </h2>
                
                <p class="text-slate-500 mt-2">
                Reset Password with Logic Anchor Governance
                </p>
    
            </div>  
            <div class="border-t pt-6">
    
                <p class="text-sm"> Enter your email and password reset instructions will be sent to you.</p>
                
                <form  method="POST" action="{{ route('forgot.password.post') }}">
                @csrf
                    <div class="mb-4 mt-4">
                    
                    <label class="text-base font-semibold block mb-1">
                    Email
                    </label>
                    
                    <input
                    type="email"
                    value="{{ old('email') }}"
                    name="email"
                     placeholder="Enter your email"
                     required
                    class="w-full px-4 py-3 border rounded-lg  @error('email') border-red-500 @enderror">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    </div>
                
                    
            
                    
       
                    <button
                    class="w-full py-3 bg-slate-900 text-white rounded-xl font-semibold mt-2">
                    Send recovery email
                    </button>
                
                </form>
                  <div class=" mx-auto text-slate-500 2xl:mt-12 mt-8 uppercase text-sm" style="text-align:center">
                Forget it?

                <a href="{{ route('login') }}" class="text-slate-900  font-medium hover:underline">
                    Back to Sign In
                </a>
            </div>
    
            </div>
    
        </div>

         
    </div>

@endsection

