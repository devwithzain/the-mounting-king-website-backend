<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return response()->json([
            'data' => EmployeeResource::collection($employees)
        ], 200);
    }
    public function store(EmployeeRequest $request)
    {
        $validatedData = $request->validated();
        $employees = Employee::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'address' => $validatedData['address'],
            'phone_number' => $validatedData['phone_number'],
            'state' => $validatedData['state'],
        ]);
        return response()->json([
            'message' => 'Employee created successfully.',
            'employees' => $employees
        ]);
    }
    public function show(string $id)
    {
        $employees = Employee::find($id);
        if (!$employees) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }

        return response()->json([
            'data' => new EmployeeResource($employees)
        ], 200);
    }
    public function update(EmployeeRequest $request, string $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }
        $validatedData = $request->validated();
        $employee->name = $validatedData['name'];
        $employee->email = $validatedData['email'];
        $employee->address = $validatedData['address'];
        $employee->phone_number = $validatedData['phone_number'];
        $employee->state = $validatedData['state'];

        $employee->save();
        return response()->json([
            'message' => 'Employee updated successfully.',
            'employee' => $employee
        ]);

    }
    public function destroy(string $id)
    {
        $employees = Employee::find($id);
        if (!$employees) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }

        $employees->delete();
        return response()->json([
            'message' => 'Employee deleted successfully.'
        ]);
    }
}