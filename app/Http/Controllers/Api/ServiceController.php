<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return response()->json([
            'data' => ServiceResource::collection($services)
        ], 200);
    }
    public function store(ServiceRequest $request)
    {
        $validatedData = $request->validated();
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(32) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'services/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
        }
        $service = Service::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'short_description' => $validatedData['short_description'],
            'image' => $imagePath,
        ]);

        return response()->json([
            'message' => 'Service created successfully.',
            'service' => $service
        ]);
    }
    public function show(string $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }

        return response()->json([
            'data' => new ServiceResource($service)
        ], 200);
    }
    public function update(ServiceRequest $request, string $id)
    {
        // dd($request->all());
        try {
            $service = Service::find($id);
            // dd($service);
            if (!$service) {
                return response()->json([
                    'error' => 'Not Found.'
                ], 404);
            }

            $validated = $request->validated();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Str::random(32) . '.' . $image->getClientOriginalExtension();
                $imagePath = 'services/' . $imageName;
                Storage::disk('public')->put($imagePath, file_get_contents($image));
                $validated['image'] = $imagePath;
            }

            $service->update($validated);

            return response()->json([
                'success' => "Service successfully updated.",
                'data' => new ServiceResource($service)
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
        $service = Service::find($id);
        if (!$service) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }

        $service->delete();

        return response()->json([
            'success' => "Service successfully deleted."
        ], 200);
    }
}