<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarif; 

class TarifController extends Controller
{
    public function index()
    {
        $tarifs = Tarif::paginate(3);
        return response()->json([
            'tarifs' => $tarifs
        ], 200);    
    }

    public function store(Request $request)
    {

            $request->validate([

                'exp_zone' => 'required',
                'del_duration' => 'required',
                'max_pound' => 'required',
                'min_pound' => 'required',
                'tarif_price' => 'required',
                'deliveryId' => 'required',
            ]);
    
            $tarif = new Tarif();
            $tarif->exp_zone = $request->exp_zone;
            $tarif->del_duration = $request->del_duration;
            $tarif->max_pound = $request->max_pound;
            $tarif->min_pound = $request->min_pound;
            $tarif->tarif_price = $request->tarif_price;
            $tarif->deliveryId = $request->deliveryId;
            $tarif->save();

            return response()->json($tarif, 201);

    }

    public function update(Request $request, $id)
    {
        try {
            $tarif = Tarif::find($id);
            if (!$tarif) {
                return response()->json([
                    'message' => 'Tarif Not Found.'
                ], 404);
            }
 
            $request->validate([
                'exp_zone' => 'required',
                'del_duration' => 'required',
                'max_pound' => 'required',
                'min_pound' => 'required',
                'tarif_price' => 'required',
                'deliveryId' => 'required',
            ]);

            $tarif->exp_zone = $request->exp_zone;
            $tarif->del_duration = $request->del_duration;
            $tarif->max_pound = $request->max_pound;
            $tarif->min_pound = $request->min_pound;
            $tarif->tarif_price = $request->tarif_price;
            $tarif->deliveryId = $request->deliveryId;
           
            $tarif->save();
 
            return response()->json([
                'results' => "Tarif successfully updated."
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'message' => "Something went really wrong!",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {

        $tarif = Tarif::find($id);
        if (!$tarif) {
            return response()->json([
                'message' => 'Product Not Found.'
            ], 404);
        }
 
        $tarif->delete();
        
        return response()->json([
            'message' => "Product successfully deleted."
        ], 200);
    }
}
