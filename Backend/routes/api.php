<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BillController; // Ajout de cette ligne pour importer le BillController

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

Route::get('tarifs', [TarifController::class, 'index']);
Route::post('tarifs', [TarifController::class, 'store']);
Route::put('tarifsupdate/{id}', [TarifController::class, 'update']);
Route::delete('tarifdelete/{id}', [TarifController::class, 'destroy']);

Route::get('deliveries', [DeliveryController::class, 'index']);
Route::post('deliveries', [DeliveryController::class, 'store']);
Route::put('deliveriesupdate/{id}', [DeliveryController::class, 'update']);
Route::delete('deliverydelete/{id}', [DeliveryController::class, 'destroy']);
