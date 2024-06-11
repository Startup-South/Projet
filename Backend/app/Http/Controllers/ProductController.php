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
            $productname = $request->productname;
            $price = $request->price;
            $description = $request->description;
            $quantity = $request->quantity;
            $is_available = $request->is_available;
            $imageName = Str::random(32) . "." . $request->image->getClientOriginalExtension();

            Storage::disk('public')->put($imageName, file_get_contents($request->image));

            Product::create([
                'productname' => $productname,
                'image' => $imageName,
                'price' => $price,
                'description' => $description,
                'quantity' => $quantity,
                'is_available' => $is_available
            ]);

            // Return JSON Response
            return response()->json([
                'message' => "Product successfully created. '$productname' -- '$imageName' -- '$price'"
            ], 200);
        } catch (\Exception $e) {
            // Return JSON Response
            return response()->json([
                'message' => "Something went really wrong!"
            ], 500);
        }
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Product Not Found.'
            ], 404);
        }

        // Return JSON Response
        return response()->json([
            'product' => $product
        ], 200);
    }

    public function update(ProductStoreRequest $request, $id)
    {
        try {
            // Find product
            $product = Product::find($id);
            if (!$product) {
                return response()->json([
                    'message' => 'Product Not Found.'
                ], 404);
            }

            $product->productname = $request->productname;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->quantity = $request->quantity;
            $product->is_available = $request->is_available;

            if ($request->hasFile('image')) {
                // Public storage
                $storage = Storage::disk('public');

                // Old image delete
                if ($storage->exists($product->image)) {
                    $storage->delete($product->image);
                }

                // Image name
                $imageName = Str::random(32) . "." . $request->image->getClientOriginalExtension();
                $product->image = $imageName;

                // Image save in public folder
                $storage->put($imageName, file_get_contents($request->image));
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
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Product Not Found.'
            ], 404);
        }

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
