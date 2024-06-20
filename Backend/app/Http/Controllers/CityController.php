<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\City;

class CityController extends Controller
{
    public function index()
    {
        //
        $city = City::all();
        return response()->json($city);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try {


        //validation
        $request->validate([
            'PaysCode' => 'required|max:4',
            'PaysName' => 'required|max:32',
            'SecondName' => 'nullable|max:60',
            'Flag' => 'required|file'
        ]);
        $city = new City();
        $city->PaysCode = $request->input('PaysCode');
        $city->PaysName = $request->input('PaysName');
        $city->SecondName = $request->input('SecondName');

        // Gestion du fichier 'Flag'
        if ($request->hasFile('Flag')) {
                $fichier = $request->file('Flag');
                $nomFichier = time().'.'.$fichier->getClientOriginalExtension();
                $chemin = $fichier->storeAs('City', $nomFichier);
                $city->Flag = $chemin;
         }

         // Sauvegarde de l'objet City
        $city->save();

        // Retourner la réponse JSON en cas de succès
            return response()->json(['message' => 'City created successfully', 'data' => $city], 201);
        } catch (\Exception $e) {
            // Retourner une réponse JSON en cas d'erreur
            return response()->json(['error' => 'An error occurred while creating the city', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // Récupération de cité par son ID
        $city = City::findOrFail($id);

        // Retourner la réponse en JSON
        return response()->json($city);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      try {
              // Validation des données entrantes
              $validatedData = $request->validate([
                  'PaysCode' => 'required|max:4',
                  'PaysName' => 'required|max:32',
                  'SecondName' => 'nullable|max:60',
                  'Flag' => 'sometimes|file|mimes:jpg,jpeg,png|max:2048' // Ajout de règles de validation pour le fichier
              ]);

              // Trouver l'élément à mettre à jour
              $city = City::findOrFail($id);

              // Gestion du fichier s'il est présent dans la requête
              if ($request->hasFile('Flag')) {
                  $fichier = $request->file('Flag');
                  $nomFichier = time().'.'.$fichier->getClientOriginalExtension();
                  $chemin = $fichier->storeAs('City', $nomFichier);

                  // Supprimer l'ancien fichier si nécessaire
                  if ($city->Flag) {
                      Storage::delete($city->Flag);
                  }

                  // Mettre à jour le chemin du fichier dans les données validées
                  $validatedData['Flag'] = $chemin;
              }

              // Mise à jour de l'élément avec les données validées
              $city->update($validatedData);

              // Retourner l'élément mis à jour comme un objet JSON
              return response()->json($city, 200);

          } catch (\Illuminate\Validation\ValidationException $e) {
              // En cas d'erreur de validation, retourner une réponse JSON avec les messages d'erreur
              return response()->json(['errors' => $e->errors()], 422);
          } catch (\Exception $e) {
              // En cas d'autres erreurs, retourner une réponse JSON avec le message d'erreur
              return response()->json(['error' => $e->getMessage()], 500);
          }
      }
    public function destroy(string $id)
    {
        // Trouver l'élément à supprimer
        $city = City::findOrFail($id);
        // Supprimer le fichier associé si nécessaire
        if ($city->Flag) {
            Storage::delete($city->Flag);
        }
        // Supprimer l'élément
        $city->delete();

        // Retourner une réponse indiquant que la suppression a réussi
        return response()->json(['message' => 'City deleted successfully'], 200);
    }
}
