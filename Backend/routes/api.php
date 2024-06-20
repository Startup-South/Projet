<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BillController; // Ajout de cette ligne pour importer le BillController
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EmployeeController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'store']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});

// Routes pour les factures
Route::get('/bills', [BillController::class, 'index']);        // Obtenir toutes les factures
Route::post('/bills', [BillController::class, 'store']);       // Créer une nouvelle facture
Route::get('/bills/{id}', [BillController::class, 'show']);    // Obtenir une facture spécifique
Route::put('/bills/{id}', [BillController::class, 'update']);  // Mettre à jour une facture spécifique
Route::delete('/bills/{id}', [BillController::class, 'destroy']); // Supprimer une facture spécifique


Route::get('/clients', [ClientController::class, 'index']);        // Obtenir toutes les factures
Route::post('/clients', [ClientController::class, 'store']);       // Créer une nouvelle facture
Route::get('/clients/{id}', [ClientController::class, 'show']);    // Obtenir une facture spécifique
Route::put('/clients/{id}', [ClientController::class, 'update']);  // Mettre à jour une facture spécifique
Route::delete('/clients/{id}', [ClientController::class, 'destroy']); // Supprimer une facture spécifique


Route::get('/commands', [CommandController::class, 'index']);        // Obtenir toutes les factures
Route::post('/commands', [CommandController::class, 'store']);       // Créer une nouvelle facture
Route::get('/commands/{id}', [CommandController::class, 'show']);    // Obtenir une facture spécifique
Route::put('/commands/{id}', [CommandController::class, 'update']);  // Mettre à jour une facture spécifique
Route::delete('/commands/{id}', [CommandController::class, 'destroy']); // Supprimer une facture spécifique



// Route to get all blogs
Route::get('/blogs', [BlogController::class, 'index']);

// Route to create a new blog
Route::post('/blogs', [BlogController::class, 'store']);

// Route to get a specific blog by id
Route::get('/blogs/{id}', [BlogController::class, 'show']);

// Route to update a specific blog by id
Route::put('/blogs/{id}', [BlogController::class, 'update']);

// Route to delete a specific blog by id
Route::delete('/blogs/{id}', [BlogController::class, 'destroy']);

Route::get('/employees', [EmployeeController::class, 'index']);        // Obtenir toutes les factures
Route::post('/employees', [EmployeeController::class, 'store']);       // Créer une nouvelle facture
Route::get('/employees/{id}', [EmployeeController::class, 'show']);    // Obtenir une facture spécifique
Route::put('/employees/{id}', [EmployeeController::class, 'update']);  // Mettre à jour une facture spécifique
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']); // Supprimer une facture spécifique


