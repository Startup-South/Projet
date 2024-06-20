<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      // Définir les règles de validation
        $rules = [
            'ClientFirstname' => 'required|string|max:255',
            'ClientLastname' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'ClientPhone' => 'required|string|max:15',
            'codePostale' => 'required|string|max:10',
            'adresse_facturation' => 'required|string|max:255',
            'adresse_livraison' => 'required|string|max:255',
            'adresse_email' => 'required|email|unique:clients,adresse_email', // Unique sur la table clients
            'password' => 'required|string|min:8', // Assurez-vous que le champ password_confirmation existe
            'genre' => 'required|string|in:Homme,Femme,Autre,Préférer ne pas dire',
            'Subscription' => 'nullable|boolean', // Peut être nul
            'date_inscription' => 'required|date',
        ];
        // Valider les données de la requête
        $validator = Validator::make($request->all(), $rules);

        // Vérifier si la validation échoue
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        // Créer et sauvegarder un nouveau Client
        $client = new Client();
        $client->ClientFirstname = $request->ClientFirstname;
        $client->ClientLastname = $request->ClientLastname;
        $client->date_naissance = $request->date_naissance;
        $client->ClientPhone = $request->ClientPhone;
        $client->codePostale = $request->codePostale;
        $client->adresse_facturation = $request->adresse_facturation;
        $client->adresse_livraison = $request->adresse_livraison;
        $client->adresse_email = $request->adresse_email;
        $client->password = Hash::make($request->password); // Hasher le mot de passe
        $client->genre = $request->genre;
        $client->Subscription = $request->Subscription ?? false; // Définir une valeur par défaut
        $client->date_inscription = $request->date_inscription;
        $client->save();
        // Retourner une réponse réussie
        return response()->json([
            'message' => 'Client créé avec succès!',
            'client' => $client
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
