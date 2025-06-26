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
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|boolean',
        ]);

        // Create a new branch
        Branch::create([
            'name' => $request->input('name'),
            'status' => 1,
        ]);

        // Redirect back with a success message
        return redirect()->route('branch.index')->with('success', 'Branch created successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        // Delete the branch
        $branch->delete();

        // Redirect back with a success message
        return redirect()->route('branch.index')->with('success', 'Branch deleted successfully.');
    }
}
