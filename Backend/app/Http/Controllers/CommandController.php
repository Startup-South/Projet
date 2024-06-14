<?php

namespace App\Http\Controllers;

use App\Models\Command; // Assurez-vous d'importer le modèle Command
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Importez le façade Validator
use Illuminate\Support\Facades\Log; // Importez le façade Log

class CommandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commands = Command::all(); // Utilisez le pluriel pour la variable car elle contient plusieurs commandes
        return response()->json($commands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'CommandDate' => 'required|date', // Ajout de 'required' pour s'assurer que la date est présente
            'PaymentStatus' => 'required|string|max:255', // Ajout de 'required'
            'CommandStatus' => 'required|string|max:255', // Ajout de 'required'
            'DeliveryMode' => 'required|string|max:255', // Ajout de 'required'
            'Comment' => 'nullable|string|max:255', // 'nullable' pour les champs optionnels
            'ClientId' => 'required|integer|exists:clients,id', // Ajout de 'required'
            'ProductId' => 'required|integer|exists:products,id', // Ajout de 'required'
            'BillId' => 'required|integer|exists:bills,id', // Ajout de 'required'
            'Article' => 'required|integer', // 'nullable' pour les champs optionnels
        ]);

        // Vérification des erreurs de validation
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Création de la commande
            $command = Command::create($validator->validated());

            return response()->json([
                'message' => "Command successfully created.",
                'command' => $command,
            ], 201);
        } catch (\Exception $e) {
            // Enregistrement de l'erreur dans les logs
            Log::error("Error creating command: " . $e->getMessage());

            return response()->json([
                'message' => "Something went really wrong!",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id) // Enlevez le type 'string' pour permettre la conversion automatique des types
    {
        $command = Command::find($id);
        if ($command) {
            return response()->json($command);
        } else {
            return response()->json(['message' => 'Command not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $command = Command::find($id);
        if (!$command) {
            return response()->json(['message' => 'Command not found'], 404);
        }


        $validator = Validator::make($request->all(), [
            'CommandDate' => 'sometimes|required|date',
            'PaymentStatus' => 'sometimes|required|string|max:255',
            'CommandStatus' => 'sometimes|required|numeric',
            'DeliveryMode' => 'sometimes|required|string|max:255',
            'Comment' => 'sometimes|required|string|max:255',
            'ClientId' => 'sometimes|required|integer|exists:clients,id',
            'ProductId' => 'sometimes|required|integer|exists:products,id',
            'BillId' => 'sometimes|required|integer|exists:bills,id',
            'Article' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $command->update($validator->validated());

            return response()->json([
                'message' => "Command successfully updated.",
                'command' => $command,
            ], 200);
        } catch (\Exception $e) {
            Log::error("Error updating command: " . $e->getMessage());

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
        $command = Command::find($id);
        if (!$command) {
            return response()->json(['message' => 'Command not found'], 404);
        }

        try {
            $command->delete();

            return response()->json(['message' => 'Command successfully deleted'], 200);
        } catch (\Exception $e) {
            Log::error("Error deleting command: " . $e->getMessage());

            return response()->json([
                'message' => "Something went really wrong!",
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
