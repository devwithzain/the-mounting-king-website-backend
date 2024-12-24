<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'data' => ProductResource::collection($products)
        ], 200);
    }
    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = Str::random(32) . '.' . $image->getClientOriginalExtension();
                $imagePath = 'products/' . $imageName;
                Storage::disk('public')->put($imagePath, file_get_contents($image));
                $imagePaths[] = $imagePath;
            }
        }
        $product = Product::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'shortDescription' => $validatedData['shortDescription'],
            'color' => $validatedData['color'],
            'category' => $validatedData['category'],
            'size' => $validatedData['size'],
            'price' => $validatedData['price'],
            'images' => json_encode($imagePaths),
        ]);
        return response()->json([
            'message' => 'Product created successfully.',
            'product' => $product
        ]);
    }
    public function show(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }

        return response()->json([
            'data' => new ProductResource($product)
        ], 200);
    }
    public function update(ProductRequest $request, string $id)
    {
        try {
            $product = Product::find($id);

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
                'data' => new ProductResource($product)
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
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'error' => 'Not Found.'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'success' => "Product successfully deleted."
        ], 200);
    }
}