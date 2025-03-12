<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
   
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

   
    public function register(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins', 
            'password' => 'required|string|min:8|confirmed', 
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator) 
                ->withInput();
        }

        
        $admin = Admin::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
        ]);

        Auth::guard('admin')->login($admin);

        return redirect('/')->with('success', 'Registration successful!'); 
    }
}