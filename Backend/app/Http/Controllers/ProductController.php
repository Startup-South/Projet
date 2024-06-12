<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductStoreRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(5);

        // Return JSON Response
        return response()->json([
            'products' => $products
        ], 200);
    }

    public function store(ProductStoreRequest $request)
    {
        try {
            $imageName = Str::uuid() . "." . $request->file('image')->getClientOriginalExtension();

            Storage::disk('public')->put($imageName, file_get_contents($request->file('image')));

            Product::create([
                'productname' => $request->productname,
                'image' => $imageName,
                'price' => $request->price,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'weight' => $request->weight,
                'size' => $request->size,
                'is_available' => $request->is_available
            ]);

            // Return JSON Response
            return response()->json([
                'message' => "Product successfully created."
            ], 200);
        } catch (\Exception $e) {
            // Return JSON Response
            return response()->json([
                'message' => "Something went really wrong!",
                'error' => $e->getMessage(),
                'trace' => $e->getTrace()
            ], 500);
        }
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Return JSON Response
        return response()->json([
            'product' => $product
        ], 200);
    }

    public function update(ProductStoreRequest $request, $id)
    {
        try {
            // Find product
            $product = Product::findOrFail($id);

            $product->productname = $request->productname;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->quantity = $request->quantity;
            $product->weight = $request->weight;
            $product->size = $request->size;
            $product->is_available = $request->is_available;

            if ($request->hasFile('image')) {
                // Public storage
                $storage = Storage::disk('public');

                // Old image delete
                if ($storage->exists($product->image)) {
                    $storage->delete($product->image);
                }

                // Image name
                $imageName = Str::uuid() . "." . $request->file('image')->getClientOriginalExtension();
                $product->image = $imageName;

                // Image save in public folder
                $storage->put($imageName, file_get_contents($request->file('image')));
            }

            // Update Product
            $product->save();

            // Return JSON Response
            return response()->json([
                'message' => "Product successfully updated."
            ], 200);
        } catch (\Exception $e) {
            // Return JSON Response
            return response()->json([
                'message' => "Something went really wrong!"
            ], 500);
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Public storage
        $storage = Storage::disk('public');

        // Image delete
        if ($storage->exists($product->image)) {
            $storage->delete($product->image);
        }

        // Delete Product
        $product->delete();

        // Return JSON Response
        return response()->json([
            'message' => "Product successfully deleted."
        ], 200);
    }
}
