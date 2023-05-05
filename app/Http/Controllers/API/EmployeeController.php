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
        $employees = Employee::query()->latest()->paginate(5);
        return response()->json($employees);
    }

    public function show(Employee $employee): JsonResponse
    {

        $data = [
            'data' => $employee,
            'message' => "Employee retrieved"
        ];

        return response()->json($data);
    }

    public function store(Request $request): JsonResponse
    {
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->save();

        $data = [
            'data' => $employee,
            'message' => "Employee added"
        ];
        return response()->json($data);
    }

    public function update(Request $request, Employee $employee): JsonResponse
    {
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->save();

        $data = [
            'data' => $employee,
            'message' => "Employee updated"
        ];

        return response()->json($data);
    }

    public function destroy(Employee $employee): JsonResponse
    {
        $employee->delete();

        return response()->json();
    }
}
