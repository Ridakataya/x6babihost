<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
    public function index()
    {
        $properties = Property::all();
        return response()->json([
            'success' => true,
            'data' => $properties
        ] , 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate rules
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'host_id' => 'required|exists:users,id',
        ];
        $request->validate(rules: $rules);

            
        $property = Property::create([
            'title' => $request->title,
            'description' => $request->description,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'host_id' => $request->host_id,
            
        ]);
        

        return response()->json([
            'success' => true,
            'data' => $property
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $property = Property::find($id);
        if (!$property) {
            return response()->json([
                'success' => false,
                'message' => 'Property not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $property
        ], 200);
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate rules
        $rules = [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'address' => 'sometimes|required|string|max:255',
            'city' => 'sometimes|required|string|max:100',
            'country' => 'sometimes|required|string|max:100',
            'host_id' => 'sometimes|required|exists:users,id',
        ];
        $request->validate(rules: $rules);

        $property = Property::find($id);
        if (!$property) {
            return response()->json([
                'success' => false,
                'message' => 'Property not found'
            ], 404);
        }
        $property->update($request->only([
            'title',
            'description',
            'address',
            'city',
            'country',
            'host_id'
        ]));
        return response()->json([
            'success' => true,
            'data' => $property
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $property = Property::find($id);
        if (!$property) {
            return response()->json([
                'success' => false,
                'message' => 'Property not found'
            ], 404);
        }
        $property->delete();
        return response()->json([
            'success' => true,
            'message' => 'Property deleted successfully'
        ], 200);
    }
}
