<?php

namespace App\Http\Controllers\Api;

use App\Models\Advantage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AdvantageRequest;
use App\Http\Resources\AdvantageResource;

class AdvantageController extends Controller
{
    public function index()
    {
        $advantage = Advantage::get();
        if ($advantage->count() > 0) {
            return AdvantageResource::collection($advantage);
        } else {
            return response()->json([
                'status' => 404,
                'error' => 'Content Not Found'
            ], 404);
        }
    }
    public function store(AdvantageRequest $request)
    {
        try {
            $validated = $request->validated();

            $title = $validated['title'];
            $subTitle = $validated['subTitle'];
            $serviceTitle1 = $validated['serviceTitle1'];
            $serviceTitle2 = $validated['serviceTitle2'];
            $serviceTitle3 = $validated['serviceTitle3'];
            $serviceDescription1 = $validated['serviceDescription1'];
            $serviceDescription2 = $validated['serviceDescription2'];
            $serviceDescription3 = $validated['serviceDescription3'];
            $serviceImage1 = $validated['serviceImage1'];
            $serviceImage2 = $validated['serviceImage2'];
            $serviceImage3 = $validated['serviceImage3'];

            $serviceImage1 = Str::random(32) . '.' . $request->serviceImage1->getClientOriginalExtension();
            Storage::disk('public')->put($serviceImage1, file_get_contents($request->serviceImage1));

            $serviceImage2 = Str::random(32) . '.' . $request->serviceImage2->getClientOriginalExtension();
            Storage::disk('public')->put($serviceImage2, file_get_contents($request->serviceImage2));

            $serviceImage3 = Str::random(32) . '.' . $request->serviceImage3->getClientOriginalExtension();
            Storage::disk('public')->put($serviceImage3, file_get_contents($request->serviceImage3));

            $advantage = Advantage::create([
                'title' => $title,
                'subTitle' => $subTitle,
                'serviceTitle1' => $serviceTitle1,
                'serviceTitle2' => $serviceTitle2,
                'serviceTitle3' => $serviceTitle3,
                'serviceDescription1' => $serviceDescription1,
                'serviceDescription2' => $serviceDescription2,
                'serviceDescription3' => $serviceDescription3,
                'serviceImage1' => $serviceImage1,
                'serviceImage2' => $serviceImage2,
                'serviceImage3' => $serviceImage3,
            ]);

            return response()->json([
                'success' => 'Content successfully created.',
                'data' => new AdvantageResource($advantage),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong!',
            ], 500);
        }
    }
    public function show(string $id)
    {
        $advantage = Advantage::find($id);
        if (!$advantage) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }

        return response()->json([
            'data' => new AdvantageResource($advantage)
        ], 200);
    }
    public function update(AdvantageRequest $request, string $id)
    {
        try {
            $advantage = Advantage::where('id', $id)->first();
            if (!$advantage) {
                return response()->json([
                    'error' => 'Not Found.'
                ], 404);
            }

            $validated = $request->validated();

            $advantage->update($validated);

            return response()->json([
                'success' => "Content successfully updated."
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => "Something went wrong!"
            ], 500);
        }
    }
    public function destroy(string $id)
    {
        $advantage = Advantage::find($id);
        if (!$advantage) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }

        $advantage->delete();

        return response()->json([
            'success' => "Content successfully deleted."
        ], 200);
    }
}