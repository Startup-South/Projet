<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::all();
        return response()->json($bills);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'BillCode' => 'required|string|max:255',
            'TotalPrice' => 'required|numeric',
            'Article' => 'required|string|max:255',
            'DeliveryPrice' => 'required|numeric',
            'BillProduct' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $bill = Bill::create($validator->validated());

            return response()->json([
                'message' => "Bill successfully created.",
                'bill' => $bill,
            ], 201);
        } catch (\Exception $e) {
            // Log l'erreur pour un débogage ultérieur
            \Log::error("Error creating bill: " . $e->getMessage());

            return response()->json([
                'message' => "Something went really wrong!",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $bill = Bill::findOrFail($id);
            return response()->json($bill);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Bill not found',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'BillCode' => 'sometimes|required|string|max:255',
            'TotalPrice' => 'sometimes|required|numeric',
            'Article' => 'sometimes|required|string|max:255',
            'DeliveryPrice' => 'sometimes|required|numeric',
            'BillProduct' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $bill = Bill::findOrFail($id);
            $bill->update($validator->validated());

            return response()->json([
                'message' => 'Bill successfully updated.',
                'bill' => $bill,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went really wrong!",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $bill = Bill::findOrFail($id);
            $bill->delete();
            return response()->json([
                'message' => 'Bill successfully deleted.'
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went really wrong!",
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
