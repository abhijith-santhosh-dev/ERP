<?php

namespace App\Http\Controllers;
use App\Http\Requests\DesignationRequest;
use App\Models\Designation;

use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::all();
        return view('designations.index', compact('designations'));
    }
    public function create()
    {
        return view('designations.create');
    }

    public function store(DesignationRequest $request)
    {
        $designation = Designation::create([
            'title' => $request->title,
            'is_active' => $request->has('is_active'),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Designation created successfully.',
                'designation' => $designation
            ]);
        }

        return redirect()->route('designations.index')
            ->with('success', 'Designation created successfully.');
    }

    public function edit(Designation $designation)
    {
        return view('designations.edit', compact('designation'));
    }

    
    public function update(DesignationRequest $request, Designation $designation)
    {
        $designation->update([
            'title' => $request->title,
            'is_active' => $request->has('is_active'),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Designation updated successfully.',
                'designation' => $designation
            ]);
        }

        return redirect()->route('designations.index')
            ->with('success', 'Designation updated successfully.');
    }


}
