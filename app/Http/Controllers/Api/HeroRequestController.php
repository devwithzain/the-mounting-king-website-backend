<?php

namespace App\Http\Controllers\Api;

use App\Models\HeroRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\HeroRequestRequest;
use App\Http\Resources\HeroRequestResource;

class HeroRequestController extends Controller
{
    public function index()
    {
        $heroRequest = HeroRequest::all();
        return response()->json([
            'data' => HeroRequestResource::collection($heroRequest)
        ], 200);
    }
    public function store(HeroRequestRequest $request)
    {
        $validatedData = $request->validated();

        $heroRequest = HeroRequest::create([
            'title' => $validatedData['title'],
        ]);

        return response()->json([
            'message' => 'Content created successfully.',
            'service' => $heroRequest
        ]);
    }
    public function show(string $id)
    {
        $heroRequest = HeroRequest::find($id);
        if (!$heroRequest) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }

        return response()->json([
            'data' => new HeroRequestResource($heroRequest)
        ], 200);
    }
    public function update(HeroRequestRequest $request, string $id)
    {
        try {
            $heroRequest = HeroRequest::find($id);

            if (!$heroRequest) {
                return response()->json([
                    'error' => 'Not Found.'
                ], 404);
            }

            $validated = $request->validated();

            $heroRequest->update($validated);

            return response()->json([
                'success' => "Content successfully updated.",
                'data' => new HeroRequestResource($heroRequest)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => "Something went wrong!",
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy(string $id)
    {
        $heroRequest = HeroRequest::find($id);
        if (!$heroRequest) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }

        $heroRequest->delete();

        return response()->json([
            'success' => "Content successfully deleted."
        ], 200);
    }
}