<?php

namespace App\Http\Controllers\Api;

use App\Models\HomeService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\HomeServiceRequest;
use App\Http\Resources\HomeServiceResources;

class HomeServiceController extends Controller
{
    public function index()
    {
        $homeService = HomeService::get();
        if ($homeService->count() > 0) {
            return HomeServiceResources::collection($homeService);
        } else {
            return response()->json([
                'status' => 404,
                'error' => 'HomeService section Content Not Found'
            ], 404);
        }
    }
    public function store(HomeServiceRequest $request)
    {
        try {
            $validated = $request->validated();

            $title = $validated['title'];
            $heading = $validated['heading'];
            $description = $validated['description'];

            $imageName = Str::random(32) . '.' . $request->image->getClientOriginalExtension();
            Storage::disk('public')->put($imageName, file_get_contents($request->image));

            $homeService = HomeService::create([
                'title' => $title,
                'heading' => $heading,
                'description' => $description,
                'image' => $imageName,
            ]);

            return response()->json([
                'success' => 'Content successfully created.',
                'data' => new HomeServiceResources($homeService),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong!',
            ], 500);
        }
    }
    public function show(string $id)
    {
        $homeService = HomeService::find($id);
        if (!$homeService) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }

        return response()->json([
            'data' => new HomeServiceResources($homeService)
        ], 200);
    }
    public function update(Request $request, string $id)
    {
        try {
            $homeService = HomeService::where('id', $id)->first();
            if (!$homeService) {
                return response()->json([
                    'error' => 'Not Found.'
                ], 404);
            }

            $homeService->title = $request->input('title');
            $homeService->subHeading = $request->input('subHeading');
            $homeService->description = $request->input('description');
            $homeService->image = $request->input('image');
            $homeService->save();

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
        $homeService = HomeService::find($id);
        if (!$homeService) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }

        $homeService->delete();

        return response()->json([
            'success' => "Content successfully deleted."
        ], 200);
    }
}