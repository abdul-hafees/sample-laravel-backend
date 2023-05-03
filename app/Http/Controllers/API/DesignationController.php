<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index(): JsonResponse
    {
        $designations = Designation::query()->latest()->get();
        return response()->json($designations);
    }

    public function show(Designation $designation): JsonResponse
    {

        $data = [
            'data' => $designation,
            'message' => "Designation retrieved"
        ];

        return response()->json($data);
    }

    public function store(Request $request): JsonResponse
    {
        $designation = new Designation();
        $designation->name = $request->name;
        $designation->save();

        $data = [
            'data' => $designation,
            'message' => "Designation added"
        ];
        return response()->json($data);
    }

    public function update(Request $request, Designation $designation): JsonResponse
    {
        $designation->name = $request->name;
        $designation->save();

        $data = [
            'data' => $designation,
            'message' => "Designation updated"
        ];

        return response()->json($data);
    }

    public function destroy(Designation $designation): JsonResponse
    {
        $designation->delete();

        return response()->json();
    }
}
