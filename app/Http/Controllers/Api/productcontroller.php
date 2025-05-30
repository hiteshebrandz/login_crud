<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET /api/products
    public function index()
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found'], 200);
        }

        return ProductResource::collection($products);
    }

    // POST /api/products
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'user_id' => 'nullable|integer', // Change to 'required' if needed
            'image_path' => 'nullable|string',
            'video_path' => 'nullable|string',
            'pdf_path' => 'nullable|string',
        ]);

        $product = Product::create($validated);

        return new ProductResource($product);
    }

    // GET /api/products/{id}
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return new ProductResource($product);
    }

    // PUT or PATCH /api/products/{id}
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
            'quantity' => 'sometimes|required|integer',
            'user_id' => 'sometimes|integer',
            'image_path' => 'nullable|string',
            'video_path' => 'nullable|string',
            'pdf_path' => 'nullable|string',
        ]);

        $product->update($validated);

        return new ProductResource($product);
    }

    // DELETE /api/products/{id}
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
