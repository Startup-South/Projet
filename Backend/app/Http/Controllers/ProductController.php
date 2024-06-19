<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_status' => 'required|boolean',
            'stock' => 'required|integer',
            'market_price' => 'required|numeric',
            'sale_channel' => 'nullable|string|max:255',
            'product_description' => 'nullable|string',
            'product_type' => 'required|string|max:255',
            'product_pound' => 'nullable|numeric',
            'product_city_origin' => 'required|string|max:255',
            'code_sh' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'product_code' => 'required|string|max:255',
            'product_shop' => 'required|string|max:255',
            'product_options' => 'nullable|json',
            'product_value' => 'nullable|numeric'
        ]);

        if ($request->hasFile('product_img')) {
            $image = $request->file('product_img');
            $path = $image->store('product_images', 'public');
            $validatedData['product_img'] = $path;
        }

        $product = Product::create($validatedData);
        return response()->json($product, 201);
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product, 200);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_status' => 'required|boolean',
            'stock' => 'required|integer',
            'market_price' => 'required|numeric',
            'sale_channel' => 'nullable|string|max:255',
            'product_description' => 'nullable|string',
            'product_type' => 'required|string|max:255',
            'product_pound' => 'nullable|numeric',
            'product_city_origin' => 'required|string|max:255',
            'code_sh' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'product_code' => 'required|string|max:255',
            'product_shop' => 'required|string|max:255',
            'product_options' => 'nullable|json',
            'product_value' => 'nullable|numeric'
        ]);

        if ($request->hasFile('product_img')) {
            // Delete old image if exists
            if ($product->product_img) {
                Storage::disk('public')->delete($product->product_img);
            }
            $image = $request->file('product_img');
            $path = $image->store('product_images', 'public');
            $validatedData['product_img'] = $path;
        }

        $product->update($validatedData);
        return response()->json($product, 200);
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        if ($product->product_img) {
            Storage::disk('public')->delete($product->product_img);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
