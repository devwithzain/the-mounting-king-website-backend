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
        $image = $request->file('image');
        $imageName = 'services/' . Str::random(32) . '.' . $image->getClientOriginalExtension();
        Storage::disk('public')->put($imageName, file_get_contents($image));
        $service = Service::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'short_description' => $validatedData['short_description'],
            'image' => $imageName,
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
        $service = Service::find($id);
        if (!$service) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }
        $validatedData = $request->validated();
        $service->title = $validatedData['title'];
        $service->description = $validatedData['description'];
        $service->short_description = $validatedData['short_description'];

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $image = $request->file('image');
            $imageName = 'services/' . Str::random(32) . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put($imageName, file_get_contents($image));

            $service->image = $imageName;
        }
        $service->save();
        return response()->json([
            'message' => 'Service updated successfully.',
            'service' => $service
        ]);

    }
    public function destroy(string $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        $service->delete();
        return response()->json([
            'message' => 'Service deleted successfully.'
        ]);
    }
}