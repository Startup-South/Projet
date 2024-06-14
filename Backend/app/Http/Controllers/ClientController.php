<?php

namespace App\Http\Controllers;

use App\Models\Client; // Assurez-vous d'importer le modèle Client
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Importez le façade Validator
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return response()->json($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Name' => 'required|string|max:255', // La clé doit être en minuscules
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $client = Client::create($validator->validated());

            return response()->json([
                'message' => "Client successfully created.",
                'client' => $client,
            ], 201);
        } catch (\Exception $e) {
            \Log::error("Error creating client: " . $e->getMessage());

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
        $client = Client::find($id);
        if ($client) {
            return response()->json($client);
        } else {
            return response()->json(['message' => 'Client not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'Name' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $client->update($validator->validated());

            return response()->json([
                'message' => "Client successfully updated.",
                'client' => $client,
            ], 200);
        } catch (\Exception $e) {
            \Log::error("Error updating client: " . $e->getMessage());

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
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        try {
            $client->delete();

            return response()->json(['message' => 'Client successfully deleted'], 200);
        } catch (\Exception $e) {
            \Log::error("Error deleting client: " . $e->getMessage());

            return response()->json([
                'message' => "Something went really wrong!",
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
