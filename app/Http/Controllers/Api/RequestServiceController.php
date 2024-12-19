<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\RequestServices;
use App\Models\RequestServicesSteps;
use App\Http\Controllers\Controller;
use App\Models\RequestServicesOptions;

class RequestServiceController extends Controller
{
    public function index()
    {
        $requestServices = RequestServices::with('steps.options')->get();
        return response()->json([
            'data' => $requestServices
        ], 200);
    }
    public function store(Request $request)
    {
        // Step 1: Validate and Create Service
        $validatedService = $request->validate([
            'service_title' => 'required|string|max:255',
            'service_description' => 'required|string',
        ]);

        $service = RequestServices::create($validatedService);

        // Step 2: Add Steps and Options
        if ($request->has('steps')) {
            foreach ($request->steps as $step) {
                $validatedStep = [
                    'request_services_id' => $service->id,
                    'step_title' => $step['step_title'],
                    'step_description' => $step['step_description'],
                ];

                $serviceStep = RequestServicesSteps::create($validatedStep);

                // Add Options
                if (isset($step['options'])) {
                    foreach ($step['options'] as $option) {
                        $validatedOption = [
                            'request_services_steps_id' => $serviceStep->id,
                            'size' => $option['size'],
                            'time' => $option['time'],
                            'price' => $option['price'],
                        ];

                        RequestServicesOptions::create($validatedOption);
                    }
                }
            }
        }

        return response()->json([
            'message' => 'Service created successfully!',
            'service' => $service->load('steps.options'),
        ], 201);
    }
    public function show(string $id)
    {
        $requestServices = RequestServices::with('steps.options')->find($id);
        if (!$requestServices) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }

        return response()->json([
            'data' => $requestServices
        ], 200);
    }
    public function destroy(string $id)
    {
        $requestServices = RequestServices::find($id);
        if (!$requestServices) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }

        $requestServices->delete();

        return response()->json([
            'success' => "Content successfully deleted."
        ], 200);
    }
}