<?php

namespace App\Http\Controllers\Api;

use App\Models\HeroService;
use App\Http\Controllers\Controller;
use App\Http\Requests\HeroServiceRequest;
use App\Http\Resources\HeroServiceResource;

class HeroServiceController extends Controller
{
    public function index()
    {
        $heroService = HeroService::all();
        return response()->json([
            'data' => HeroServiceResource::collection($heroService)
        ], 200);
    }
    public function store(HeroServiceRequest $request)
    {
        $validatedData = $request->validated();

        $heroService = HeroService::create([
            'title' => $validatedData['title'],
        ]);

        return response()->json([
            'message' => 'Hero Service created successfully.',
            'service' => $heroService
        ]);
    }
    public function show(string $id)
    {
        $heroService = HeroService::find($id);
        if (!$heroService) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }

        return response()->json([
            'data' => new HeroServiceResource($heroService)
        ], 200);
    }
    public function update(HeroServiceRequest $request, string $id)
    {
        try {
            $heroService = HeroService::find($id);

            if (!$heroService) {
                return response()->json([
                    'error' => 'Not Found.'
                ], 404);
            }

            $validated = $request->validated();

            $heroService->update($validated);

            return response()->json([
                'success' => "Hero Service successfully updated.",
                'data' => new HeroServiceResource($heroService)
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
        $heroService = HeroService::find($id);
        if (!$heroService) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }

        $heroService->delete();

        return response()->json([
            'success' => "Hero Service successfully deleted."
        ], 200);
    }
}