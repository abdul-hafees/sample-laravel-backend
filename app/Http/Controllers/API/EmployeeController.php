<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(): JsonResponse
    {
        $employees = Employee::query()->latest()->get();
        return response()->json($employees);
    }

    public function show(Employee $employee): JsonResponse
    {
        return response()->json($employee);
    }

    public function store(Request $request): JsonResponse
    {
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->save();

        return response()->json();
    }

    public function update(Request $request, Employee $employee): JsonResponse
    {
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->save();

        return response()->json();
    }

    public function destroy(Employee $employee): JsonResponse
    {
        $employee->delete();

        return response()->json();
    }
}
