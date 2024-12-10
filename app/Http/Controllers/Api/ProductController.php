<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        try {
            $validated = $request->validated();

            $title = $validated['title'];
            $price = $validated['price'];
            $description = $validated['description'];

            $imageName = Str::random(32) . '.' . $request->image->getClientOriginalExtension();
            Storage::disk('public')->put($imageName, file_get_contents($request->image));

            $product = Product::create([
                'title' => $title,
                'price' => $price,
                'description' => $description,
                'image' => $imageName,
            ]);

            return response()->json([
                'success' => 'Product successfully created.',
                'data' => new ProductResource($product),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong!',
            ], 500);
        }
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
            'product' => new ProductResource($product)
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