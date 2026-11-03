@extends('auth.layout') @section('title', 'Signup') @section('content')
<!-- <div class="left-column relative z-[1]">
    <div class="max-w-[520px] pt-20 ltr:pl-20 rtl:pr-20">
        <a href="index.html">
            <img src="{{ asset('backend/assets/images/logo/logo.svg')}}" alt="" class="mb-10 dark_logo" />
            <img src="{{ asset('backend/assets/images/logo/logo-white.svg')}}" alt="" class="mb-10 white_logo" />
        </a>
        <h4>
            Unlock your Project
            <span class="text-slate-800 dark:text-slate-400 font-bold"> performance </span>
        </h4>
    </div>
    <div class="absolute left-0 2xl:bottom-[-160px] bottom-[-130px] h-full w-full z-[-1]">
        <img src="{{ asset('backend/assets/images/auth/ils1.svg')}}" alt="" class="h-full w-full object-contain" />
    </div>
</div> -->
<div class="right-column relative">
    <div class="inner-content h-full flex flex-col bg-white dark:bg-slate-800">
        <div class="auth-box h-full flex flex-col justify-center">
            <div class="mobile-logo text-center mb-2 block">
                <a href="index.html">
                    <img src="{{asset('backend/assets/logo/image1.png')}}" alt="" class="mb-3 dark_logo" />
                    <img src="{{asset('backend/assets/logo/image1.png')}}" alt="" class="mb-3 white_logo" />
                </a>
            </div>
            <div class="text-center 2xl:mb-4">
                <h4 class="font-medium">Sign in</h4>
                <div class="text-slate-500 text-base">Sign in to your account to start using Logic Anchor Governance</div>
            </div>

            <!-- BEGIN: Registration Form -->
            <form class="space-y-4" method="POST" action="{{ route('register.post') }}">
                @csrf

                <div class="fromGroup">
                    <label class="block capitalize form-label">Name</label>
                    <div class="relative">
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control py-2"
                            placeholder="Enter your name"
                            required
                        />
                    </div>
                </div>

                <div class="fromGroup">
                    <label class="block capitalize form-label">Email</label>
                    <div class="relative">
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control py-2"
                            placeholder="Enter your email"
                            required
                        />
                    </div>
                </div>
                
                <div class="fromGroup">
                    <label class="block capitalize form-label">Phone</label>
                    <div class="relative">
                        <input
                            type="tel"
                            name="phone"
                            value="{{ old('phone') }}"
                            class="form-control py-2"
                            placeholder="Enter your Phone"
                            
                        />
                    </div>
                </div>

                <div class="fromGroup">
                    <label class="block capitalize form-label">Password</label>
                    <div class="relative">
                        <input
                            type="password"
                            name="password"
                            class="form-control py-2"
                            placeholder="Enter your password"
                            required
                        />
                    </div>
                </div>

                <div class="fromGroup">
                    <label class="block capitalize form-label">Confirm Password</label>
                    <div class="relative">
                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control py-2"
                            placeholder="Confirm password"
                            required
                        />
                    </div>
                </div>

                <div class="flex justify-between">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="terms" value="1" required />
                        <span class="text-slate-500 text-sm leading-6 capitalize ml-2">
                            I accept Terms & Conditions and Privacy Policy
                        </span>
                    </label>
                </div>

                <button class="btn btn-dark block w-full text-center">Create an account</button>
            </form>
            <!-- END: Registration Form -->

            <div class="md:max-w-[345px] mx-auto font-normal text-slate-500 dark:text-slate-400 mt-8 uppercase text-sm">
                <span>ALREADY REGISTERED? </span>
                <a href="{{route('login')}}" class="text-slate-900 dark:text-white font-medium hover:underline">
                    Sign In
                </a>
            </div>
        </div>
        <div class="auth-footer text-center">Copyright {{ date('Y') }}, LOGIC-ANCHOR GOVERNANCE All Rights Reserved.</div>
    </div>
</div>

@endsection
