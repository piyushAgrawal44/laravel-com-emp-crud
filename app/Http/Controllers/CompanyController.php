<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve paginated companies from the database
        $companies = Company::paginate(10); // Change 10 to the number of companies per page you want

        // Pass the paginated companies to the view for rendering
        return view('company.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'email|max:255',
            'logo' => 'image|max:2048', // Adjust max file size as needed
        ]);
    
        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $fileName = Str::random(20) . '.' . $logo->getClientOriginalExtension();
            $path = $logo->storeAs('public/logos', $fileName);
            $validatedData['logo'] = Storage::url($path);
        }
    
        // Create a new company instance with the validated data
        $company = Company::create($validatedData);
    
        // Redirect the user to a relevant page (e.g., company details page)
        return redirect()->route('company', $company->id)->with('success', 'Company created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);

        // Pass the company data to the view for editing
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            // Find the company by its ID
        $company = Company::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'logo' => 'nullable|image|max:2048', // Adjust max file size as needed
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            
            $logo = $request->file('logo');
            $fileName = Str::random(20) . '.' . $logo->getClientOriginalExtension();
            $path = $logo->storeAs('public/logos', $fileName);
            // Store the path to the logo without the 'public' prefix
            $validatedData['logo'] = Storage::url($path);

            if ($company->logo) {
                Storage::delete(str_replace('/storage', 'public', $company->logo));
            }
        }

        // Update the company with the validated data
        $company->update($validatedData);

        // Redirect the user to a relevant page
        return redirect()->route('company')->with('success', 'Company updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the company by its ID
        $company = Company::findOrFail($id);

        // Delete the company
        $company->delete();

        // Redirect the user to a relevant page 
        return redirect()->route('company')->with('success', 'Company deleted successfully!');
    }
}
