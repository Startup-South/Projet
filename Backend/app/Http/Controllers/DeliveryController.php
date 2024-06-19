<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery; 

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::paginate(3);
        return response()->json([
            'deliveries' => $deliveries
        ], 200);    
    }

    public function store(Request $request)
    {
           $validatedData = $request->validate([
  
            'del_name' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
            ]);

            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $path = $image->store('logo_image', 'public');
                $validatedData['logo'] = $path;
            }

            $delivery = Delivery::create($validatedData);
            return response()->json($delivery, 201);

        }

    public function update(Request $request, $id)
    {
            $delivery = Delivery::find($id);
            
            if (!$delivery) {
                return response()->json([
                    'message' => 'Delivery Not Found.'
                ], 404);
            }
 
            $validatedData = $request->validate([
                'del_name' => 'required',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ]);

            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $path = $image->store('logo_image', 'public');
                $validatedData['logo'] = $path;
            }

            $delivery->update($validatedData);

           return response()->json([
            'message' => "Delivery successfully updated.."
        ], 200);
    }

    public function destroy($id)
    {

        $delivery = Delivery::find($id);
        if (!$delivery) {
            return response()->json([
                'message' => 'Delivery Not Found.'
            ], 404);
        }
 
        $delivery->delete();
        
        return response()->json([
            'message' => "Delivery successfully deleted."
        ], 200);
    }
}
