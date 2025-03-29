<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\EmailVerificationCode;



class VerificationController extends Controller
{
    public function show()
    {
        $user = auth()->user();
    
        // Not logged in? block just in case
        if (!$user) {
            abort(403);
        }
    
        // Already verified? Redirect to dashboard
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }
    
        return view('auth.verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:4',
        ], [
            'code.required' => 'Please enter a code.',
            'code.digits' => 'The code must be exactly 4 digits.',
        ]);
    
        $user = auth()->user();
    
        if (!$user->verification_code || !$user->code_expires_at) {
            return back()->withErrors(['code' => 'No verification code found. Please request a new one.']);
        }
    
        if ($user->code_expires_at->isPast()) {
            return back()->withErrors(['code' => 'Your code has expired. <a href="' . route('verification.resend') . '">Send a new code?</a>'])->withInput();
        }
    
        if ($user->verification_code !== $request->code) {
            return back()->withErrors(['code' => 'The code entered is incorrect.'])->withInput();
        }
    
        $user->markEmailVerified();
        return redirect()->route('dashboard');
    }

public function resend()
{
    auth()->user()->notify(new EmailVerificationCode());
        return back()->with('success','A new code was sent');
}
}
