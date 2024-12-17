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

        $service = Service::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
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
        try {
            $product = Service::find($id);

            if (!$product) {
                return response()->json([
                    'error' => 'Not Found.'
                ], 404);
            }

            $validated = $request->validated();

            // Handle the image
            if ($request->hasFile('image')) {
                // Delete old image
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }

                // Store new image
                $imageName = Str::random(32) . '.' . $request->image->getClientOriginalExtension();
                Storage::disk('public')->put($imageName, file_get_contents($request->image));
                $validated['image'] = $imageName;
            }

            // Update the product
            $product->update($validated);

            return response()->json([
                'success' => "Product successfully updated.",
                'data' => new ServiceResource($product)
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