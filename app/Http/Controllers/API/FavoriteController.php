<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favorites = Favorite::all();
        return response()->json([
            'success' => true,
            'data' => $favorites
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
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
        ];
        $request->validate(rules: $rules);

            
        $favorite = Favorite::create([
            'user_id' => $request->user_id,
            'property_id' => $request->property_id,
        ]);
        

        return response()->json([
            'success' => true,
            'data' => $favorite
        ] , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $favorite = Favorite::find($id);
        if(!$favorite) {
            return response()->json([
                'success' => false,
                'message' => 'Favorite not found'
            ] , 404);
        }
        return response()->json([
            'success' => true,
            'data' => $favorite
        ] , 200);
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
        $favorite = Favorite::find($id);
        if(!$favorite) {
            return response()->json([
                'success' => false,
                'message' => 'Favorite not found'
            ] , 404);
        }
        $favorite->delete();
        return response()->json([
            'success' => true,
            'message' => 'Favorite deleted successfully'
        ] , 200);
    }
}
