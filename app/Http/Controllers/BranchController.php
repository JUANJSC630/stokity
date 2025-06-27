<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
        }
        // Fetch all branch from the database
        $branches = Branch::all();

        // Return the branches view with the branches data
        return view('pages.branches', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|boolean',
        ]);

        // Create a new branch
        Branch::create([
            'name' => $request->input('name'),
            'status' => 1,
        ]);

        // Redirect back with a success message
        return redirect()->route('branch')->with('success', 'Sucursal creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
        }
        
        return view('pages.branch_edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
        }
        
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        // Update the branch
        $branch->update([
            'name' => $request->input('name'),
            'status' => $request->input('status'),
        ]);

        // Redirect back with a success message
        return redirect()->route('branch')->with('success', 'Sucursal actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        // Delete the branch
        $branch->delete();

        // Redirect back with a success message
        return redirect()->route('branch')->with('success', 'Sucursal eliminada correctamente.');
    }
}
