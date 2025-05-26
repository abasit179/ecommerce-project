<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Session::put('admin_logged_in', true);
            Session::put('admin_id', $admin->id);

            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->route('admin.login')->withErrors(['error' => 'Invalid credentials']);
    }

    // Show password reset form
    public function showForgotPasswordForm()
    {
        return view('admin.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $admin = Admin::where('email', $request->email)->first();

    if (!$admin) {
        return back()->withErrors(['email' => 'No account found with that email address.']);
    }

    // Generate a new token
    $token = Str::random(60);

    // Store the token in the admin_password_resets table
    DB::table('admin_password_resets')->updateOrInsert(
        ['email' => $admin->email],
        ['token' => $token, 'created_at' => now()]
    );

    $resetLink = url('/admin/password/reset/' . $token . '?email=' . urlencode($admin->email));

    // Send the password reset email using the Mail facade with a view
    Mail::send('emails.admin_password_reset', ['resetLink' => $resetLink], function ($message) use ($admin) {
        $message->to($admin->email)
            ->subject('Reset Password Notification');
    });

    return back()->with('status', 'Password reset link has been sent to your email address.');
}


    // Show reset password form
    public function showResetPasswordForm($token)
    {
        return view('admin.auth.reset-password', ['token' => $token, 'email' => request('email')]);
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        // Find the admin by email
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'No account found with that email address.']);
        }

        // Check if the token is valid
        $record = DB::table('admin_password_resets')->where('email', $request->email)->where('token', $request->token)->first();

        if (!$record) {
            return back()->withErrors(['token' => 'This password reset token is invalid.']);
        }

        // Update the admin password
        $admin->password = Hash::make($request->password);
        $admin->save();

        // Delete the password reset record
        DB::table('admin_password_resets')->where('email', $request->email)->delete();

        return redirect()->route('admin.login')->with('status', 'Password has been reset successfully.');
    }

    public function logout()
    {
        Session::forget('admin_logged_in');
        Session::forget('admin_id');

        return redirect()->route('admin.login');
    }
}
