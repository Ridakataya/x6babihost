<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Amenity;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $amenities = Amenity::all();
        return response()->json([
            'success' => true,
            'data' => $amenities
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
        $request->validate(rules: $rules);

            
        $amenity = Amenity::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        

        return response()->json([
            'success' => true,
            'data' => $amenity
        ] , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $amenity = Amenity::find($id);
        if (!$amenity) {
            return response()->json([
                'success' => false,
                'message' => 'Amenity not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $amenity
        ], 200);
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
        $amenity = Amenity::find($id);
        if (!$amenity) {
            return response()->json([
                'success' => false,
                'message' => 'Amenity not found'
            ], 404);
        }
        $amenity->delete();
        return response()->json([
            'success' => true,
            'message' => 'Amenity deleted successfully'
        ], 200);
    }
}
