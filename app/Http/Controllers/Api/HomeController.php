<?php

namespace App\Http\Controllers\Api;

use App\Models\Home;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\HomeRequest;
use App\Http\Resources\HomeResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $home = Home::get();
        if ($home->count() > 0) {
            return HomeResource::collection($home);
        } else {
            return response()->json([
                'status' => 404,
                'error' => 'Home Content Not Found'
            ], 404);
        }
    }
    public function store(HomeRequest $request)
    {
        try {
            $validated = $request->validated();

            $heading = $validated['heading'];
            $subHeading = $validated['subHeading'];
            $description = $validated['description'];

            $imageName = Str::random(32) . '.' . $request->image->getClientOriginalExtension();
            Storage::disk('public')->put($imageName, file_get_contents($request->image));

            $home = Home::create([
                'heading' => $heading,
                'subHeading' => $subHeading,
                'description' => $description,
                'image' => $imageName,
            ]);

            return response()->json([
                'success' => 'Content successfully created.',
                'data' => new HomeResource($home),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong!',
            ], 500);
        }
    }
    public function show(string $id)
    {
        $home = Home::find($id);
        if (!$home) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }

        return response()->json([
            'home' => new HomeResource($home)
        ], 200);
    }
    public function update(Request $request, string $id)
    {
        try {
            $home = Home::where('id', $id)->first();
            if (!$home) {
                return response()->json([
                    'error' => 'Not Found.'
                ], 404);
            }

            $home->heading = $request->input('heading');
            $home->subHeading = $request->input('subHeading');
            $home->description = $request->input('description');
            $home->image = $request->input('image');
            $home->save();

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
        $home = Home::find($id);
        if (!$home) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }

        $home->delete();

        return response()->json([
            'success' => "Content successfully deleted."
        ], 200);
    }
}