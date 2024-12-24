<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductHero;
use App\Http\Controllers\Controller;
use App\Http\Requests\HeroProductRequest;
use App\Http\Resources\ProductHeroResource;

class ProductHeroController extends Controller
{
    public function index()
    {
        $heroRequest = ProductHero::all();
        return response()->json([
            'data' => ProductHeroResource::collection($heroRequest)
        ], 200);
    }
    public function update(HeroProductRequest $request, string $id)
    {
        $slot = ProductHero::findOrFail($id);
        $slot->update($request->all());
        return response()->json(['success' => 'Slot updated successfully!']);
    }
}