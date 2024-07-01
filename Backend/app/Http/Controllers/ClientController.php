<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; // Pour hasher les mots de passe
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      // Récupérer tous les clients
              $clients = Client::all();

              // Retourner une réponse réussie avec la liste des clients
              return response()->json([
                  'clients' => $clients
              ], 200);
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
      // Récupérer le client par son ID
              $client = Client::find($id);

              // Vérifier si le client existe
              if (!$client) {
                  return response()->json([
                      'message' => 'Client non trouvé.'
                  ], 404);
              }

              // Retourner une réponse réussie avec les détails du client
              return response()->json([
                  'client' => $client
              ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, $id)
 {
     $validatedData = $request->validate([
         'ClientFirstname' => 'required|string|max:255',
         'ClientLastname' => 'required|string|max:255',
         'date_naissance' => 'required|date',
         'ClientPhone' => 'required|string|max:15',
         'codePostale' => 'required|string|max:10',
         'adresse_facturation' => 'required|string|max:255',
         'adresse_livraison' => 'required|string|max:255',
         'adresse_email' => 'sometimes|email|', // Unique sauf pour le client actuel
         'password' => 'required|string|min:8', // nullable pour permettre de ne pas le changer
         'genre' => 'required|string|in:Homme,Femme,Autre,Préférer ne pas dire',
         'Subscription' => 'nullable|boolean', // Peut être nul
         'date_inscription' => 'required|date',
    ]);

    // Mise à jour des champs
    $client->ClientFirstname = $validatedData['ClientFirstname'];
    $client->ClientLastname = $validatedData['ClientLastname'];
    $client->date_naissance = $validatedData['date_naissance'];
    $client->ClientPhone = $validatedData['ClientPhone'];
    $client->codePostale = $validatedData['codePostale'];
    $client->adresse_facturation = $validatedData['adresse_facturation'];
    $client->adresse_livraison = $validatedData['adresse_livraison'];
    $client->adresse_email = $validatedData['adresse_email'];
    $client->password = $validatedData['password'];
    $client->genre = $validatedData['genre'];
    $client->Subscription = $validatedData['Subscription'];
    $client->date_inscription = $validatedData['date_inscription'];

    //récupérer le modèle par son identifiant (id)
    $client = Client::findOrFail($id);


    // mise a  jour de Model
       $client->update($validatedData);

       // Retourne une réponse appropriée
       return response()->json(['message' => 'Client updated successfully', 'client' => $client], 200);
 }


    public function destroy(string $id)
    {
        //
    }
}
