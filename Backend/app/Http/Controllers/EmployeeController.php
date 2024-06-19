<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'EmployeeFirstname' => 'required|string|max:100',
            'EmployeeLastname' => 'required|string|max:100',
            'EmployeeEmail' => 'required|string|email|max:50|unique:employees,EmployeeEmail',
            'IsEmployeeEmailVerified' => 'required|boolean',
            'Autorisation' => 'nullable|string',
            'EmployeeRole' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $employee = Employee::create($validator->validated());

            return response()->json([
                'message' => "Employee successfully created.",
                'employee' => $employee,
            ], 201);
        } catch (\Exception $e) {
        Log::error("Error creating employee: " . $e->getMessage());

            return response()->json([
                'message' => "Something went wrong!",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            return response()->json($employee);
        } else {
            return response()->json(['message' => 'Employee not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'EmployeeFirstname' => 'required|string|max:100',
            'EmployeeLastname' => 'required|string|max:100',
            'EmployeeEmail' => 'required|string|email|max:50|unique:employees,EmployeeEmail',
            'IsEmployeeEmailVerified' => 'required|boolean',
            'Autorisation' => 'nullable|string',
            'EmployeeRole' => 'required|integer',

            
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $employee->update($validator->validated());

            return response()->json([
                'message' => "Employee successfully updated.",
                'employee' => $employee,
            ], 200);
        } catch (\Exception $e) {
            Log::error("Error updating employee: " . $e->getMessage());

            return response()->json([
                'message' => "Something went wrong!",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        try {
            $employee->delete();

            return response()->json(['message' => 'Employee successfully deleted'], 200);
        } catch (\Exception $e) {
            Log::error("Error deleting employee: " . $e->getMessage());

            return response()->json([
                'message' => "Something went wrong!",
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
