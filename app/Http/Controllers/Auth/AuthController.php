<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\UserQuestionnaire;


class AuthController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
    
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $remember = $request->has('remember');
    
        if (Auth::attempt($credentials, $remember)) {
    
            $request->session()->regenerate();
    
            $user = Auth::user();
    
            // check if account active
            if (!$user->is_active) {
                Auth::logout();
                return back()->with('error','Your account is inactive.');
            }
    
            // redirect based on role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success','Welcome Admin');
            }
    
            return redirect()->route('valut')
                ->with('success','Login successful');
    
        }
    
        return back()
            ->withInput($request->only('email'))
            ->with('error','Invalid email or password');
    }
    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

    public function register()
    {
        return view('auth.signup');
    }

    public function registerPostNew(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',

            'q1' => 'required',
            'q2' => 'required',
            'q3' => 'required',
            'q4' => 'required',
            'q5' => 'required',
        ]);


        // Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        // Prepare Answers JSON
        $answers = [
            'q1' => $request->q1,
            'q2' => $request->q2,
            'q3' => $request->q3,
            'q4' => $request->q4,
            'q5' => $request->q5,
        ];


        // Save Questionnaire
        UserQuestionnaire::create([
            'user_id' => $user->id,
            'answers' => $answers,
            'status' => 'completed'
        ]);


        // Login user (optional)
        Auth::login($user);


        return redirect()->route('dashboard')
            ->with('success','Registration successful');
    }

    public function registerPost(Request $request)
    {
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'terms' => 'accepted'
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'role' => 'customer',
            'is_active' => 1,
            'phone' => $request->phone,
        ]);
    
        return redirect()
            ->route('login')
            ->with('success','Registration successful');
    }

    /*
    |--------------------------------------------------------------------------
    | FORGOT PASSWORD
    |--------------------------------------------------------------------------
    */

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function forgotPasswordPost(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with('success', __($status))
                    : back()->withErrors(['email' => __($status)]);

    }

    /*
    |--------------------------------------------------------------------------
    | RESET PASSWORD
    |--------------------------------------------------------------------------
    */

    public function resetPassword($token)
    {
        return view('auth.reset-password',[
            'token' => $token
        ]);
    }

    public function resetPasswordPost(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);

        $status = Password::reset(

            $request->only('email','password','password_confirmation','token'),

            function ($user, $password) {

                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

            }

        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('success','Password reset successful')
                    : back()->withErrors(['email'=>[__($status)]]);

    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');

    }

}
