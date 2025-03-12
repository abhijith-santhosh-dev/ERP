<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $designations = Designation::all();
        
        $query = User::with('designation')->orderBy('name', 'asc');
        
        // Apply filters
        if ($request->filled('designation_id')) {
            $query->where('designation_id', $request->designation_id);
        }
        
        if ($request->filled('status')) {
            $status = $request->status === 'active';
            $query->where('is_active', $status);
        }
        
        $users = $query->get();
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'html' => view('users.partials.list', compact('users'))->render()
            ]);
        }
        
        return view('users.index', compact('users', 'designations'));
    }

    public function create()
    {
        $designations = Designation::active()->get();
        return view('users.create', compact('designations'));
    }
   
    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => Hash::make($request->password),
            'contact_number' => $request->contact_number,
            'alternative_contact_number' => $request->alternative_contact_number,
            'address' => $request->address,
            'designation_id' => $request->designation_id,
            'is_active' => $request->has('is_active'),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'User created successfully.',
                'user' => $user->load('designation')
            ]);
        }

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $designations = Designation::active()->get();
        return view('users.edit', compact('user', 'designations'));
    }


    public function update(UserRequest $request, User $user)
    {
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'alternative_contact_number' => $request->alternative_contact_number,
            'address' => $request->address,
            'designation_id' => $request->designation_id,
            'is_active' => $request->has('is_active'),
        ];
        
        // if ($request->filled('password')) {
        //     $userData['password'] = Hash::make($request->password);
        // }
        
        $user->update($userData);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully.',
                'user' => $user->load('designation')
            ]);
        }

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

}
