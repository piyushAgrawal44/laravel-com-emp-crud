<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee; 
use App\Models\Company; 

class EmployeeController extends Controller
{
    public function index()
    {
        // Retrieve paginated employees from the database
        $employees = Employee::with('company')->paginate(10);

        // Pass the paginated employees to the view for rendering
        return view('employee.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();

        // Pass the companies to the view
        return view('employee.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company_id' => 'required|exists:companies,id', // Validate that the company ID exists in the companies table
        ]);
    
       
        // Create a new instance with the validated data
        $employee = Employee::create($validatedData);
    
        // Redirect the user to a relevant page (e.g., company details page)
        return redirect()->route('employee')->with('success', 'Employee created successfully!');
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
        $employee = Employee::findOrFail($id);
        $companies = Company::all();
        // Pass the company data to the view for editing
        return view('employee.edit', compact('employee','companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            // Find the company by its ID
        // Find the employee by its ID
    $employee = Employee::findOrFail($id);

    // Validate the incoming request data
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:20',
        'company_id' => 'required|exists:companies,id', // Validate that the company ID exists in the companies table
    ]);

    // Update the employee with the validated data
    $employee->update($validatedData);

    // Redirect the user to a relevant page
    return redirect()->route('employee')->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the company by its ID
        $company = Employee::findOrFail($id);

        // Delete the company
        $company->delete();

        // Redirect the user to a relevant page 
        return redirect()->route('employee')->with('success', 'Employee deleted successfully!');
    }
}
